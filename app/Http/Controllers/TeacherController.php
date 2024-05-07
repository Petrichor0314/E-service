<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;

class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('admin.teacher.list',$data);
    }

    public function add(){
        $data['header_title'] = "Add New Teacher";
        return view('admin.teacher.add',$data);
    }


    public function insert(Request $request)
    {

    request()->validate([
    'email' => 'required|email|unique:users',
    'mobile_number' => 'max:15|min:8',
    'marital_status' => 'max:50',
    ]);




    
    }

    
    
}
