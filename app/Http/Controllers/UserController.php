<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{   
    public function MyAccount(){
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = 'My Account ';
        if(Auth::user()->user_type == 1)
        {
            return view('admin.my_account',$data);
        }
        else if(Auth::user()->user_type == 2)
        {
            return view('teacher.my_account',$data);
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('student.my_account',$data);

        }

    }
    public function UpdateMyAccountAdmin(Request $request){
        $id = Auth::user()->id;
        request()->validate([
            'email' =>'required|email|unique:users,email,'.$id,
           
            
        ]);
        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        $admin->save();
        return redirect('admin/account')->with('success',"Account successfully updated");

    }
    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' =>'required|email|unique:users,email,'.$id,
            'mobile_number'=>'max:15|min:10',
            
        ]);
      
        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);

        }
        if(!empty($request->file('profile_pic'))) {
              if(!empty($student->getProfile()))
              {
                unlink('upload/profile/'.$student->profile_pic);
              }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $student->profile_pic = $filename;
        }    
        
          $student->mobile_number = trim($request->mobile_number);
          $student->email = trim($request->email);
       
        
        
        $student->save();
        return redirect('student/account')->with('success',"Account successfully updated");

    }
    public function change_password(){
        $data['header_title'] = 'Change Password';
        return view('profile.change_password',$data);
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password,$user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            
            return redirect()->back()->with('success','Password Successfully Changed');
        }   
        else
        {
            return redirect()->back()->with("error","Old Password isn't correct");
        }
    }
}
