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
   public function AttendanceStudentSubmit(Request $request) {
    $StudentClass = User::getStudentClass($request->class_id);

    $attendanceParams = [
        'class_id' => $request->class_id,
        'subject_id' => $request->subject_id,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'attendance_date' => $request->attendance_date,
    ];

    $existingEntries = StudentAttendanceModel::where($attendanceParams)
                                             ->get()
                                             ->keyBy('student_id'); // Index by student_id for easy lookup

    $attendanceData = [];
    foreach ($StudentClass as $student) {
        $attendanceType = $request->has($student->id) && $request->{$student->id} == "on" ? 1 : 2;

        $attendanceRecord = [
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'attendance_date' => $request->attendance_date,
            'created_by' => Auth::user()->id,
            'student_id' => $student->id,
            'first_name' => $student->name,
            'last_name' => $student->last_name,
            'attendance_type' => $attendanceType,
            'updated_at' => now(),
        ];

        if (isset($existingEntries[$student->id])) {
            // Update existing entry
            $existingEntry = $existingEntries[$student->id];
            $existingEntry->update($attendanceRecord);
        } else {
            // Prepare new entry for insertion
            $attendanceRecord['created_at'] = now();
            $attendanceData[] = $attendanceRecord;
        }
    }

    if (!empty($attendanceData)) {
        // Insert new entries in batch
        StudentAttendanceModel::insert($attendanceData);
    }

    return back()->with('success', "Attendance Students has been successfully saved or updated");
}

   public function AttendanceReport(Request $request){
    
    $SubjectId = AssignSubjectTeacherModel::getSubjectIdByTeacherId(Auth::user()->id);
    $data['getSubject'] = SubjectModel::getSubjectByIds($SubjectId);
    $ClassId = AssignSubjectTeacherModel::getClassIdByTeacherId(Auth::user()->id);
    
    $data['getClass'] = ClassModel::getCLassByIds($ClassId);
    
    $data['getStudent'] = User::getStudentsClass($ClassId);
  
    
    if(!empty($request->class_id) || !empty($request->subject_id) || !empty($request->student_id) || !empty($request->attendance_date) || !empty($request->attendance_type) ){
        $data['getRecord'] = StudentAttendanceModel::getRecord($request->class_id,$request->subject_id,$request->student_id,$request->attendance_date,$request->attendance_type);
    }
    $data['header_title'] = "Attendance Report";
    return view('teacher.attendance.report',$data);
   }
}
