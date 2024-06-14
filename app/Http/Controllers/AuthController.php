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
        $remember = !empty($request->remember) ? true : false;
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
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
    public function PostForgotPassword(Request $request){
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
         $token = Str::random(30);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()

        ]);
        Mail::send("emails.forgot",['token' => $token],function($message) use ($request){
            $message->to($request->email);
            $message->subject("Réinitialiser le mot de passe");

        });    

         return redirect()->back()->with('success',"Veuillez vérifier votre e-mail et réinitialiser votre mot de passe"); 
        }
        else
        {
        return redirect()->back()->with('error',"L'adresse e-mail n'est pas trouvée dans le système.");
        }
        
    }
    public function reset($remember_token){
       
            return view('auth.reset',compact('remember_token'));
      
    }
    public function PostReset(Request $request)

    {
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required|string|min:6|confirmed",
            "cpassword" => "required"
        ]);
        if($request->password == $request->cpassword)   
        {
           $updatePassword = DB::table('password_reset_tokens')
           ->where([
            "email" => $request->email,
            "token" => $request->token
           ])->first();

           if(!$updatePassword){
            return redirect()->to(route("reset.password"))->with('error',"invalide");
           }
        
           User::where("email",$request->email)
                ->update(["password" => Hash::make($request->password)]);
           DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();   
           return redirect(url(''))->with('success',"Mot de passe réinitialisé avec succès");

        
        }
        else
        {
         return redirect()->back()->with('error',"Le mot de passe ne correspond pas à la confirmation du mot de passe.");
 
        }

    }
 
    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
