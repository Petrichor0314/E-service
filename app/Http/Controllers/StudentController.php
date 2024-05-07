<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Str;

use Hash;
use Auth;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = 'Student List';
        return view('admin.student.list',$data);
    }
    public function add(){
       
        $data['getClass'] = ClassModel::getClass();
        
        $data['header_title'] = 'Add new Student';
        return view('admin.student.add',$data);
    }
    public function insert(Request $request){
        request()->validate([
            'email' =>'required|email|unique:users',
            'mobile_number'=>'max:15|min:10|unique:users',
            'CIN'=>'max:15|unique:users',
            'CNE'=>'max:10|unique:users',


        
        ]);
      
        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->CIN = trim($request->CIN);
        $student->CNE = trim($request->CNE);
        $student->class_id =trim($request->class_id) ;
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);

        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $student->profile_pic = $filename;
        }    
        
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        }
       
        
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        
        $student->save();
        return redirect('admin/student/list')->with('success',"student has successfully created");
    }
    public function edit($id){
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = 'Edit  Student';
            return view('admin.student.edit',$data);
        }
        else {
            abort(404);
        }

        
    }
    public function update($id, Request $request){
        request()->validate([
            'email' =>'required|email|unique:users,email,'.$id,
            'mobile_number'=>'max:15|min:10',
            'CIN'=>'max:12',
            'CNE'=>'max:10',


        
        ]);
      
        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->CIN = trim($request->CIN);
        $student->CNE = trim($request->CNE);
        $student->class_id = trim($request->class_id) ;
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
        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        }
       
        
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password)){
            $student->password = Hash::make($request->password);

        }
        
        
        $student->save();
        return redirect('admin/student/list')->with('success',"student has successfully updated");

    }
    public function delete($id)  {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord)){
            $getRecord->is_deleted = 1;
            $getRecord->save();
            return redirect()->back()->with('success',"student has successfully deleted");

           
        }
        else {
            abort(404);
        }
        
    }
}
