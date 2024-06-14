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
    $data['header_title']= 'Tableau de bord';
    if (Auth::user()->user_type == 1) {
        $data['header_title']= 'Tableau de bord administrateur';
        $data['TotalStudent']= User::getTotalUser(3);
        $data['TotalTeacher']= User::getTotalUser(2);
        $data['TotalAdmin']= User::getTotalUser(1);
        $data['TotalClass']= CLassModel::getTotalClass();
        $data['TotalSubject']= SubjectModel::getTotalSubject();
        $data['TotalMaleStudent']= User::getTotalMaleStudent();
        $data['TotalFemaleStudent']= User::getTotalFemaleStudent();
        return view('admin.dashboard',$data);
    } else if (Auth::user()->user_type == 2) {
        $data['header_title']= 'Tableau de bord professeur';
        $data['TotalStudent']= User::getTotalUser(3);
        $data['TotalTeacher']= User::getTotalUser(2);
        $data['TotalAdmin']= User::getTotalUser(1);
        $data['TotalClass']= CLassModel::getTotalClass();
        $data['TotalSubject']= SubjectModel::getTotalSubject();
        $data['TotalMaleStudent']= User::getTotalMaleStudent();
        $data['TotalFemaleStudent']= User::getTotalFemaleStudent();
        
        if($this->isDepartementHead(Auth::user()->id)){
            $data['header_title']= 'Tableau de bord chef de département';
            $data['is_departement_head'] = $this->isDepartementHead(Auth::id());
            return view('departement_head.dashboard', $data);
        }
        else if($this->isSectorCoordinator(Auth::user()->id)){
            $data['header_title']= 'Tableau de bord coordinateur sector';
            $data['is_sector_coordinator'] = $this->isSectorCoordinator(Auth::id());
            return view('coordinator.dashboard', $data);    
        }
        return view('teacher.dashboard',$data);
    } else if (Auth::user()->user_type == 3) {
        $data['header_title']= 'Tableau de bord étudiant';
        $data['TotalStudent']= User::getTotalUser(3);
        $data['TotalTeacher']= User::getTotalUser(2);
        $data['TotalAdmin']= User::getTotalUser(1);
        $data['TotalClass']= CLassModel::getTotalClass();
        $data['TotalSubject']= SubjectModel::getTotalSubject();
        return view('student.dashboard',$data);
    }
    return redirect('login')->with('error', 'Accès refusé.');
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

