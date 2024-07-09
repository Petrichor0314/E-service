<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Hash;
use Auth;
use App\Models\User;
use App\Models\DepartementModel;
use App\Models\FiliereModel;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;
class AuthController extends Controller
{
    public function Login()
    {
       
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) 
            {
                return redirect('admin/dashboard');

            } else if (Auth::user()->user_type == 2) {
                if ($this->isDepartementHead(Auth::user()->id)) 
                {
                    return redirect('head/dashboard');

                } elseif ($this->isFiliereCoordinator(Auth::user()->id)) 
                {
                    return redirect('coordinator/dashboard');
                }
                else{
                    return redirect('teacher/dashboard');
                }
            } else if (Auth::user()->user_type == 3) {

                return redirect('student/dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                if ($this->isDepartementHead(Auth::user()->id)) {

                    return redirect('head/dashboard');

                } elseif ($this->isFiliereCoordinator(Auth::user()->id)) {

                    return redirect('coordinator/dashboard');

                } else {

                    return redirect('teacher/dashboard');
                }
            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Veuillez saisir l\'adresse e-mail et le mot de passe corrects');
        }
    }

    protected function isDepartementHead($userId)
    {
        return DepartementModel::where('head', $userId)->exists();
    }


    protected function isFiliereCoordinator($userId)
    {
        return FiliereModel::where('coord', $userId)->exists();
    }
    public function forgotpassword()
    {
          return view('auth.forgot');
    }
    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);

        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', "Un lien de reinitialisation de mot de passe a ete envoyé a votre adresse e-mail.");
        } else {
            return redirect()->back()->with('error', "L'adresse e-mail n'est pas trouvée dans le système.");
        }
    }
    public function reset(Request $request, $token)
    {
        $email = $request->query('email');
        return view('auth.reset', compact('token', 'email'));
    }
    public function PostReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$updatePassword) {
            return redirect()->route('reset.password', ['token' => $request->token, 'email' => $request->email])->with('error', 'Invalid token');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect(url(''))->with('success', 'Mot de passe réinitialisé avec succès');
    }
 
    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
