<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\FiliereModel;
use App\Models\User;
use App\Models\DepartementModel;
use App\Models\CLassModel;
use App\Models\SubjectModel;

class DashboardController extends Controller
{
   public function dashboard(){
    $data = [];
    $data['header_title']= 'Dashboard';
    if (Auth::user()->user_type == 1) {
        $data['header_title']= 'Admin Dashboard';
        $data['TotalStudent']= User::getTotalUser(3);
        $data['TotalTeacher']= User::getTotalUser(2);
        $data['TotalAdmin']= User::getTotalUser(1);
        $data['TotalClass']= CLassModel::getTotalClass();
        $data['TotalSubject']= SubjectModel::getTotalSubject();
        return view('admin.dashboard',$data);
    } else if (Auth::user()->user_type == 2) {
        $data['header_title']= 'Professor Dashboard';
        $data['TotalStudent']= User::getTotalUser(3);
        $data['TotalTeacher']= User::getTotalUser(2);
        $data['TotalAdmin']= User::getTotalUser(1);
        $data['TotalClass']= CLassModel::getTotalClass();
        $data['TotalSubject']= SubjectModel::getTotalSubject();
        $data['TotalMaleStudent']= User::getTotalMaleStudent();
        $data['TotalFemaleStudent']= User::getTotalFemaleStudent();
        
        if($this->isDepartementHead(Auth::user()->id)){
            $data['header_title']= 'Departement Head Dashboard';
            $data['is_departement_head'] = $this->isDepartementHead(Auth::id());
            return view('departement_head.dashboard', $data);
        }
        else if($this->isSectorCoordinator(Auth::user()->id)){
            $data['header_title']= 'Sector Coordinator Dashboard';
            $data['is_sector_coordinator'] = $this->isSectorCoordinator(Auth::id());
            return view('coordinator.dashboard', $data);    
        }
        return view('teacher.dashboard',$data);
    } else if (Auth::user()->user_type == 3) {
        $data['header_title']= 'Student Dashboard';
        return view('student.dashboard',$data);
    }
    return redirect('login')->with('error', 'Access denied.');
   }
   protected function isSectorCoordinator($userId)
    {
        return FiliereModel::where('coord', $userId)->exists();
    }

    protected function isDepartementHead($userId)
    {
        return DepartementModel::where('head', $userId)->exists();
    }
}
