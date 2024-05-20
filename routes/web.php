<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController; 
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentHeadModulesController;   
use App\Http\Controllers\DepartmentHeadEnseignantsController;   
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\AssignSubjectTeacherController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\AttendanceController;



use App\Http\Middleware\AdminMiddleware ;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\StudentMiddleware;
use Bootstrap\App;





/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [AuthController::class, 'Login'])->name('root');
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);

Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);



    //admin routes

Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    //departement

    Route::get('admin/departement/list', [DepartementController::class, 'list']);
    Route::get('admin/departement/add', [DepartementController::class, 'add']);
    Route::post('admin/departement/add', [DepartementController::class, 'insert']);
    Route::get('admin/departement/edit/{id}', [DepartementController::class, 'edit']);
    Route::post('admin/departement/edit/{id}', [DepartementController::class, 'update']);
    Route::get('admin/departement/delete/{id}', [DepartementController::class, 'delete']);

    //filiere

    Route::get('admin/filiere/list', [FiliereController::class, 'list']);
    Route::get('admin/filiere/add', [FiliereController::class, 'add']);
    Route::post('admin/filiere/add', [FiliereController::class, 'insert']);
    Route::get('admin/filiere/edit/{id}', [FiliereController::class, 'edit']);
    Route::post('admin/filiere/edit/{id}', [FiliereController::class, 'update']);
    Route::get('admin/filiere/delete/{id}', [FiliereController::class, 'delete']);

    //student

    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

    //teacher routes

    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);

    //class routes

    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    //subject routes

    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    //assign subject routes

    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);

    Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert_update']);
    Route::post('admin/class_timetable/delete', [ClassTimetableController::class, 'delete_session']);
    Route::get('admin/class_timetable/timetable_class/{id}', [ClassTimetableController::class, 'CLassTimetable']);




    //edit profile 
    
    Route::get('admin/account', [UserController::class, 'MyAccount']);
    Route::post('admin/account', [UserController::class, 'UpdateMyAccountAdmin']);
     

    //edit password url
    
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);


    //assign subject to a teacher

    Route::get('admin/assign_subject_teacher/list', [AssignSubjectTeacherController::class, 'list']);
    Route::get('admin/assign_subject_teacher/add', [AssignSubjectTeacherController::class, 'add']);
    Route::post('admin/assign_subject_teacher/add', [AssignSubjectTeacherController::class, 'insert']);
    Route::get('admin/assign_subject_teacher/edit/{id}', [AssignSubjectTeacherController::class, 'edit']);
    Route::post('admin/assign_subject_teacher/edit/{id}', [AssignSubjectTeacherController::class, 'update']);
    Route::get('admin/assign_subject_teacher/delete/{id}', [AssignSubjectTeacherController::class, 'delete']);
    Route::get('admin/assign_subject_teacher/edit_single/{id}', [AssignSubjectTeacherController::class, 'edit_single']);
    Route::post('admin/assign_subject_teacher/edit_single/{id}', [AssignSubjectTeacherController::class, 'update_single']);


});
    //teacher middleware 
Route::group(['middleware' => 'teacher'], function () {

    //departement head middleware

    Route::middleware(['auth', 'departement.head'])->group(function () {

        Route::get('head/dashboard', [DashboardController::class, 'dashboard']);

        //modules

        Route::get('head/modules/index', [DepartmentHeadModulesController::class, 'index'])->name('department_head.modules.index');
        Route::get('head/modules/add', [DepartmentHeadModulesController::class, 'create'])->name('department_head.subjects.create');
        Route::post('head/modules/add', [DepartmentHeadModulesController::class, 'store'])->name('department_head.subjects.store');
        Route::get('head/modules/edit/{id}', [DepartmentHeadModulesController::class, 'edit'])->name('department_head.subjects.edit');
        Route::post('head/modules/edit/{id}', [DepartmentHeadModulesController::class, 'update'])->name('department_head.subjects.update');
        Route::get('head/modules/delete/{id}', [DepartmentHeadModulesController::class, 'destroy'])->name('department_head.subjects.destroy');

        //enseignants

        Route::get('head/enseignants/index', [DepartmentHeadEnseignantsController::class, 'index'])->name('department_head.enseignants.index');
        Route::get('head/enseignants/create', [DepartmentHeadEnseignantsController::class, 'create'])->name('department_head.enseignants.create');
        Route::post('head/enseignants/store', [DepartmentHeadEnseignantsController::class, 'store'])->name('department_head.enseignants.store');
        Route::get('head/enseignants/edit/{id}', [DepartmentHeadEnseignantsController::class, 'edit'])->name('department_head.enseignants.edit');
        Route::post('head/enseignants/update/{id}', [DepartmentHeadEnseignantsController::class, 'update'])->name('department_head.enseignants.update');
        Route::delete('head/enseignants/delete/{id}', [DepartmentHeadEnseignantsController::class, 'destroy'])->name('department_head.enseignants.destroy');  
              
    });
    
    
    //sector coordinator middleware

    Route::middleware(['auth', 'sector.coordinator'])->group(function () {
        Route::get('coordinator/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('coordinator/something', [CoordinatorController::class, 'something']);

        Route::get('coordinator/assign_subject_teacher/list', [AssignSubjectTeacherController::class, 'list']);
        Route::get('coordinator/assign_subject_teacher/add', [AssignSubjectTeacherController::class, 'add']);
        Route::post('coordinator/assign_subject_teacher/add', [AssignSubjectTeacherController::class, 'insert']);
        Route::get('coordinator/assign_subject_teacher/edit/{id}', [AssignSubjectTeacherController::class, 'edit']);
        Route::post('coordinator/assign_subject_teacher/edit/{id}', [AssignSubjectTeacherController::class, 'update']);
        Route::get('coordinator/assign_subject_teacher/delete/{id}', [AssignSubjectTeacherController::class, 'delete']);
        Route::get('coordinator/assign_subject_teacher/edit_single/{id}', [AssignSubjectTeacherController::class, 'edit_single']);
        Route::post('coordinator/assign_subject_teacher/edit_single/{id}', [AssignSubjectTeacherController::class, 'update_single']);
    });
    


    //normie teacher routes

    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/account', [UserController::class, 'MyAccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccountTeacher']);
    Route::get('teacher/my_timetable', [ClassTimetableController::class, 'MyTimetableTeacher']);
    
    Route::get('teacher/attendance/student', [AttendanceController::class, 'AttendanceStudent']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'AttendanceReport']);


    Route::get('teacher/marks/list',function(){
        return view('teacher.marks.list');
    });

    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);
});

    //student routes

Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('student/account', [UserController::class, 'MyAccount']);
    Route::post('student/account', [UserController::class, 'UpdateMyAccountStudent']);
     
    Route::get('student/my_subject', [SubjectController::class, 'MySubject']);
    Route::get('student/my_timetable', [ClassTimetableController::class, 'MyTimetable']);

    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
});
