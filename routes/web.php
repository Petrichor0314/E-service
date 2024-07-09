<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StudentAttendanceModel;
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
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\DepartmentHeadModulesController;   
use App\Http\Controllers\DepartmentHeadEnseignantsController;   
use App\Http\Controllers\FiliereModuleController;
use App\Http\Controllers\DocumentController;
use App\Http\Livewire\ClassModuleDropdowns;



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

Route::get('forgot-password', [AuthController::class, 'forgotpassword'])->name('forget.password');
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword'])->name('forget.password.post');
Route::get('reset/{token}', [AuthController::class, 'reset'])->name('reset.password');
Route::post('reset', [AuthController::class, 'PostReset'])->name('reset.password.post');


    //admin routes

Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/search', [AdminController::class, 'searchAdmins'])->name('admin.admin.search');

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


    


    //export student list 

    Route::get('admin/student/export', function () {
        return Excel::download(new StudentsExport, 'students.xlsx');
    })->name('admin.student.export');

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
        Route::get('/modules/search', [DepartmentHeadModulesController::class, 'searchModules'])->name('modules.search');

        Route::get('head/modules/add', [DepartmentHeadModulesController::class, 'create'])->name('department_head.subjects.create');
        Route::post('head/modules/add', [DepartmentHeadModulesController::class, 'store'])->name('department_head.subjects.store');
        Route::get('head/modules/edit/{id}', [DepartmentHeadModulesController::class, 'edit'])->name('department_head.subjects.edit');
        Route::post('head/modules/edit/{id}', [DepartmentHeadModulesController::class, 'update'])->name('department_head.subjects.update');
        Route::get('head/modules/delete/{id}', [DepartmentHeadModulesController::class, 'destroy'])->name('department_head.subjects.destroy');

        //enseignants

        Route::get('head/enseignants/index', [DepartmentHeadEnseignantsController::class, 'index'])->name('department_head.enseignants.index');
        Route::get('/enseignants/search', [DepartmentHeadEnseignantsController::class, 'searchEnseignants'])->name('enseignants.search');
        Route::get('head/enseignants/add', [DepartmentHeadEnseignantsController::class, 'create'])->name('department_head.enseignants.create');
        Route::post('head/enseignants/add', [DepartmentHeadEnseignantsController::class, 'store'])->name('department_head.enseignants.store');
        Route::get('head/enseignants/edit/{id}', [DepartmentHeadEnseignantsController::class, 'edit'])->name('department_head.enseignants.edit');
        Route::post('head/enseignants/update/{id}', [DepartmentHeadEnseignantsController::class, 'update'])->name('department_head.enseignants.update');
        Route::delete('head/enseignants/delete/{id}', [DepartmentHeadEnseignantsController::class, 'destroy'])->name('department_head.enseignants.destroy');  
              
    });
    
    
    //sector coordinator middleware

    Route::middleware(['auth', 'sector.coordinator'])->group(function () {
        Route::get('coordinator/dashboard', [DashboardController::class, 'dashboard']);

        //modules
        Route::prefix('coordinator')->group(function () {
            Route::get('modules', [FiliereModuleController::class, 'showAssignments'])->name('coordinateur.modules.index');
            Route::post('modules', [FiliereModuleController::class, 'storeAssignments'])->name('coordinateur.modules.store');
            Route::get('affichage', [CoordinatorController::class, 'showMarksForm'])->name('coordinator.affichage');
            Route::post('getMarks', [CoordinatorController::class, 'getMarks'])->name('coordinator.getMarks');
            Route::get('exportMarks/{format}', [CoordinatorController::class, 'exportMarks'])->name('coordinator.exportMarks');
            Route::post('archive-marks', [CoordinatorController::class, 'archiveMarks'])->name('coordinator.archiveMarks');
            Route::get('archive', [CoordinatorController::class, 'showArchiveForm'])->name('coordinator.showArchiveForm');
            Route::get('view-archived-marks', [CoordinatorController::class, 'viewArchivedMarks'])->name('coordinator.viewArchivedMarks');
        });
        
    });
    
     //timetable routes
     Route::prefix('coordinator')->group(function(){
         Route::get('class_timetable/list', [ClassTimetableController::class, 'list']);
         Route::post('class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']);
         Route::post('class_timetable/add', [ClassTimetableController::class, 'insert_update']);
         Route::post('class_timetable/delete', [ClassTimetableController::class, 'delete_session']);
         Route::get('class_timetable/timetable_class/{id}', [ClassTimetableController::class, 'CLassTimetable']);
         Route::post('class_timetable/get-end-times', [ClassTimetableController::class, 'getEndTimes']);

     });





    //normie teacher routes

    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/account', [UserController::class, 'MyAccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccountTeacher']);
    Route::get('teacher/my_timetable', [ClassTimetableController::class, 'MyTimetableTeacher']);

    
    
    //attendance routes

    Route::get('teacher/attendance/student', [AttendanceController::class, 'AttendanceStudent']);
    Route::post('teacher/attendance/get_class', [AttendanceController::class, 'get_class']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'AttendanceReport']);
    Route::get('teacher/attendance/export', [AttendanceController::class, 'exportAttendanceReport'])->name('attendance.export');
    Route::post('teacher/attendance/get-end-times', [AttendanceController::class, 'getEndTimes']);

     //document routes
     Route::get('teacher/document/list', [DocumentController::class, 'list']);
     Route::get('teacher/document/add', [DocumentController::class, 'add']);
     Route::post('teacher/document/get_subject', [DocumentController::class, 'get_subject']);
     Route::post('teacher/document/add', [DocumentController::class, 'insert']);
     Route::get('teacher/document/edit/{id}', [DocumentController::class, 'edit']);
     Route::post('teacher/document/edit/{id}', [DocumentController::class, 'update']);
     Route::get('teacher/document/delete/{id}', [DocumentController::class, 'delete']);







    //marks

    Route::get('teacher/marks', [TeacherController::class, 'showMarksForm'])->name('teacher.marks.index');
// In web.php
    Route::get('/teacher/get-modules', [TeacherController::class, 'getModules'])->name('teacher.get.modules');
    Route::post('/teacher/store-marks', [TeacherController::class, 'store'])->name('teacher.marks.store');


    Route::get('teacher/get-students-marks', [TeacherController::class, 'getStudentsAndMarks'])->name('teacher.get.students.and.marks');

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
    
    Route::get('student/document/list', [DocumentController::class, 'MyDocument']);

     
    Route::get('/student/my-marks', [StudentController::class, 'showMarks'])->name('student.my.marks');
    Route::get('/student/download-marks-pdf', [StudentController::class, 'downloadMarksPdf'])->name('student.downloadMarksPdf');


    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);


    //notification

    Route::get('student/notifications/mark-as-read/{id}', [StudentController::class, 'markAsRead'])->name('student.markAsRead');

});
