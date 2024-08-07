<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{   
    public function MyAccount(){
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = 'Mon compte ';
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
            $notifications = Auth::user()->notifications()->where('read', false)->get();
            $unreadCount = $notifications->count();
            $data['unreadCount'] = $unreadCount;
            $data['notifications'] = $notifications;
            return view('student.my_account',$data);
        }

    }
    public function UpdateMyAccountAdmin(Request $request){
        $id = Auth::user()->id;
        request()->validate([
            'email' =>'required|email|unique:users,email,'.$id,
            'mobile_number'=>'max:15|min:10',
           
            
        ]);
        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->last_name = trim($request->last_name);
        $admin->gender = trim($request->gender);
        $admin->mobile_number = trim($request->mobile_number);
        if(!empty($request->date_of_birth)){
            $admin->date_of_birth = trim($request->date_of_birth);

        }
        if(!empty($request->file('profile_pic'))) {
              if(!empty($admin->getProfile()))
              {
                unlink('upload/profile/'.$admin->profile_pic);
              }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $admin->profile_pic = $filename;
        }    
        
        $admin->email = trim($request->email);
        $admin->save();
        return redirect('admin/account')->with('success',"Le compte a été mis à jour avec succès");

    }

    public function UpdateMyAccountTeacher(Request $request)
    {
        $id = Auth::user()->id; 
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
            'marital_status' => 'max:50',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->admission_date)) {
            $teacher->admission_date = trim($request->admission_date);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        /*      $teacher->address = trim($request->address);   */
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->CIN = trim($request->CIN);
        $teacher->email = trim($request->email);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect()->back()->with('success', 'Account Successfully Updated');
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
        $data['header_title'] = 'Changer le mot de passe';
        return view('profile.change_password',$data);
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password,$user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            
            return redirect()->back()->with('success','Le mot de passe a été modifié avec succès');
        }   
        else
        {
            return redirect()->back()->with("error","L'ancien mot de passe ne correspond pas");
        }
    }
   
    
}
