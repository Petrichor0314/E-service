<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
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

    // Déterminez les heures de fin disponibles en fonction de l'heure de départ sélectionnée
    $endTimes = [];

    // Logique pour déterminer les heures de fin disponibles en fonction de l'heure de départ sélectionnée
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
        // Récupérez les identifiants de sujet assignés au professeur
        $SubjectId = AssignSubjectTeacherModel::getSubjectIdByTeacherId(Auth::user()->id);
        // Obtenez les sujets en fonction des identifiants de sujet récupérés
        $data['getSubject'] = SubjectModel::getSubjectByIds($SubjectId);
    
        // Obtenez les classes associées au sujet sélectionné (le cas échéant)
        $data['getClass'] = AssignSubjectTeacherModel::ClassSubject($request->get('subject_id'));
         
        // Si l'ID de la classe et la date d'absence sont fournis, obtenez les étudiants pour cette classe
        if (!empty($request->get('class_id')) && !empty($request->get('attendance_date'))) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
            
        }
        
        $data['header_title'] = "Présence étudiants";
    
        return view('teacher.attendance.student', $data);
    }
    
    public function get_Class(Request $request) {
        // Obtenez les classes associées à l'ID de sujet fourni
        $getClass = AssignSubjectTeacherModel::ClassSubject($request->subject_id);
        
        // Construisez le HTML pour les options de classe
        $html = "<option value=''>Sélectionnez</option>";
        foreach ($getClass as $value) {
            $html .= "<option value='" . $value->class_id . "'>" . $value->class_name . "</option>";
        }
        
        // Retournez le HTML en tant que JSON
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
                                             ->keyBy('student_id'); // Index par student_id pour une recherche facile

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
            // Mise à jour de l'entrée existante
            $existingEntry = $existingEntries[$student->id];
            $existingEntry->update($attendanceRecord);
        } else {
            // Préparez une nouvelle entrée pour l'insertion
            $attendanceRecord['created_at'] = now();
            $attendanceData[] = $attendanceRecord;
        }
    }

    if (!empty($attendanceData)) {
        // Insérez les nouvelles entrées en lot
        StudentAttendanceModel::insert($attendanceData);
    }

    return back()->with('success', "La présence des étudiants a été enregistrée ou mise à jour avec succès");
}

public function AttendanceReport(Request $request)
    {
        $SubjectId = AssignSubjectTeacherModel::getSubjectIdByTeacherId(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getSubjectByIds($SubjectId);
        $ClassId = AssignSubjectTeacherModel::getClassIdByTeacherId(Auth::user()->id);
        $data['getClass'] = ClassModel::getCLassByIds($ClassId);
        $data['getStudent'] = User::getStudentsClass($ClassId);

        if (!empty($request->class_id) || !empty($request->subject_id) || !empty($request->student_id) || !empty($request->attendance_date) || !empty($request->attendance_type)) {
            $data['getRecord'] = StudentAttendanceModel::getRecord($request->class_id, $request->subject_id, $request->student_id, $request->attendance_date, $request->attendance_type);
        }

        $data['header_title'] = "Rapport d'absence";
        return view('teacher.attendance.report', $data);
    }

    public function exportAttendanceReport(Request $request)
{
    $getRecord = StudentAttendanceModel::getRecord(
        $request->class_id,
        $request->subject_id,
        $request->student_id,
        $request->attendance_date,
        $request->attendance_type
    );

    // Modify the attendance data to replace attendance_type with strings
    foreach ($getRecord as &$record) {  // Note the '&' before $record to modify it by reference
        $record['attendance_type'] = $record['attendance_type'] == 1 ? 'présent ' : 'absent';
    }
    unset($record);  // Unset reference to last item to avoid unintended modification later

    return $this->exportAttendance($getRecord);
}

public function exportAttendance($attendanceData)
{
    $collection = collect($attendanceData);
    return Excel::download(new AttendanceExport($collection), 'attendance_report.xlsx');
}

    
}

