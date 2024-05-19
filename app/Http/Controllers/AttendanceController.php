<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use Auth;
use App\Models\AssignSubjectTeacherModel;
use App\Models\SubjectModel;
use App\Models\StudentAttendanceModel;

class AttendanceController extends Controller
{
   public function AttendanceStudent(Request $request){
    $SubjectId = AssignSubjectTeacherModel::getSubjectIdByTeacherId(Auth::user()->id);
    $data['getSubject'] = SubjectModel::getSubjectByIds($SubjectId);
    $ClassId = AssignSubjectTeacherModel::getClassIdByTeacherId(Auth::user()->id);
    $data['getClass'] = ClassModel::getCLassByIds($ClassId);
    

    if(!empty($request->get('class_id')) && !empty($request->get('attendance_date'))){
        $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        
    }
    $data['header_title'] = "Student Attendance";

    return view('teacher.attendance.student',$data);
   }
   public function AttendanceStudentSubmit(Request $request){
    $StudentClass = User::getStudentClass($request->class_id);
    
    $existingEntry = StudentAttendanceModel::where('class_id', $request->class_id)
                                            ->where('subject_id',$request->subject_id)    
                                            ->where('start_time',$request->start_time)    
                                            ->where('end_time',$request->end_time)    
                                            ->where('attendance_date',$request->attendance_date)    
                                            ->first();

    if($existingEntry){
        foreach( $StudentClass as $student){
            $existingEntry->subject_id = $request->subject_id;
            $existingEntry->class_id = $request->class_id;
            $existingEntry->start_time = $request->start_time;
            $existingEntry->end_time = $request->end_time;
            $existingEntry->attendance_date = $request->attendance_date;
            $existingEntry->created_by = Auth::user()->id;
            $existingEntry->student_id = $student->id;
            $existingEntry->first_name = $student->name;
            $existingEntry->last_name = $student->last_name;
            if ($request->{$student->id} == "on") {
                $existingEntry->attendance_type = 1;
            } else {
                $existingEntry->attendance_type = 0;
            }
                
            $existingEntry->save();

        }
        return back()->with('success'," Attendance Students has successfully updated");

    }
    else{

        foreach( $StudentClass as $student){
            $attendance = new StudentAttendanceModel;
            $attendance->subject_id = $request->subject_id;
            $attendance->class_id = $request->class_id;
            $attendance->start_time = $request->start_time;
            $attendance->end_time = $request->end_time;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
            $attendance->student_id = $student->id;
            $attendance->first_name = $student->name;
            $attendance->last_name = $student->last_name;
            if ($request->{$student->id} == "on") {
                $attendance->attendance_type = 1;
            } else {
                $attendance->attendance_type = 0;
            }      
            $attendance->save();
          
        }
        return back()->with('success'," Attendance Students has successfully saved");


    }
    
    
   }
}
