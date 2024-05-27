<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mark;
use App\Models\ClassModel;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\MarksExport;
use Auth;

class CoordinatorController extends Controller
{
    public function showMarksForm()
    {
        $coordinator = Auth::user();
        $classes = ClassModel::where('filiere_id', $coordinator->filiere_id)->get();

        return view('coordinator.affichage', compact('classes'));
    }

    public function getMarks(Request $request)
    {
        $classId = $request->input('class_id');
        $moduleId = $request->input('module_id');

        $students = User::where('class_id', $classId)
                        ->where('user_type', 3)
                        ->where('is_deleted', 0)
                        ->orderBy('name', 'asc')
                        ->get();

        $studentsWithMarks = $students->map(function($student) use ($moduleId) {
            $marks = Mark::where('student_id', $student->id)
                         ->where('module_id', $moduleId)
                         ->get();
            return [
                'student' => $student,
                'marks' => $marks
            ];
        });

        return view('coordinator.marks', compact('studentsWithMarks'));
    }

    public function exportMarks(Request $request, $format)
    {
        $classId = $request->input('class_id');
        $moduleId = $request->input('module_id');

        $students = User::where('class_id', $classId)
                        ->where('user_type', 3)
                        ->where('is_deleted', 0)
                        ->orderBy('name', 'asc')
                        ->get();

        $studentsWithMarks = $students->map(function($student) use ($moduleId) {
            $marks = Mark::where('student_id', $student->id)
                         ->where('module_id', $moduleId)
                         ->get();
            return [
                'student' => $student,
                'marks' => $marks
            ];
        });

        if ($format == 'pdf') {
            $pdf = PDF::loadView('coordinator.export.marks_pdf', compact('studentsWithMarks'));
            return $pdf->download('marks.pdf');
        } elseif ($format == 'csv' || $format == 'excel') {
            return Excel::download(new MarksExport($studentsWithMarks), 'marks.' . $format);
        }
    }
}
