<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use Auth;
use App\Models\AssignSubjectTeacherModel;
use App\Models\SubjectModel;
use App\Models\StudentAttendanceModel;
use App\Models\ClassSubjectModel;


class AttendanceController extends Controller
{
    public function getEndTimes(Request $request)
{
    $startTime = $request->input('start_time');

    // Determine available end times based on the selected start time
    $endTimes = [];

    // Logic to determine available end times based on the selected start time
    if ($startTime === '08:30') {
        $endTimes = ['10:30', '12:30'];
    } elseif ($startTime === '10:30') {
        $endTimes = ['12:30'];
    } elseif ($startTime === '14:30') {
        $endTimes = ['16:30', '18:30'];
    } elseif ($startTime === '16:30') {
        $endTimes = ['18:30'];
    }

    return response()->json(['end_times' => $endTimes]);
}
    public function AttendanceStudent(Request $request) {
        // Retrieve subject IDs assigned to the teacher
        $SubjectId = AssignSubjectTeacherModel::getSubjectIdByTeacherId(Auth::user()->id);
        // Get subjects based on the retrieved subject IDs
        $data['getSubject'] = SubjectModel::getSubjectByIds($SubjectId);
    
        // Get classes associated with the selected subject (if any)
        $data['getClass'] = ClassSubjectModel::ClassSubject($request->get('subject_id'));
    
        // If class ID and attendance date are provided, get the students for that class
        if (!empty($request->get('class_id')) && !empty($request->get('attendance_date'))) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
    
        $data['header_title'] = "Student Attendance";
    
        return view('teacher.attendance.student', $data);
    }
    
    public function get_Class(Request $request) {
        // Get classes associated with the provided subject ID
        $getClass = ClassSubjectModel::ClassSubject($request->subject_id);
        
        // Build the HTML for the class options
        $html = "<option value=''>Select</option>";
        foreach ($getClass as $value) {
            $html .= "<option value='" . $value->class_id . "'>" . $value->class_name . "</option>";
        }
        
        // Return the HTML as JSON
        $json['html'] = $html;
        echo json_encode($json);
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
