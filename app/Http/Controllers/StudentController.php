<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
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
        dd($request->all());
    }
}
