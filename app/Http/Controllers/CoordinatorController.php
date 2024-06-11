<?php

namespace App\Http\Controllers;

use App\Models\DepartementModel;
use Auth;
use App\Models\Mark;
use App\Models\User;
use App\Models\ClassModel;
use App\Exports\MarksExport;
use App\Models\FiliereModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;


class CoordinatorController extends Controller
{
    public function showMarksForm()
{
    $coordinator = Auth::user();
    $filiere = FiliereModel::where('coord', $coordinator->id)->first();
    $classes = $filiere->classes;

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

        $class = ClassModel::findOrFail($classId);
        $module = SubjectModel::findOrFail($moduleId);

        $filiere = $class->filiere; 
        $teacherId = Mark::select('teacher_id')
                  ->where('class_id', $classId)
                  ->where('module_id', $moduleId)
                  ->first();

        $teacher = User::find($teacherId->teacher_id);

        $coordinator = $filiere->coordinateur;
        $department = DepartementModel::find($filiere->departements_id); 
        $currentYear = date('Y');

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
        $data = [
            'class' => $class,
            'module' => $module,
            'teacher' => $teacher,
            'department' => $department,
            'filiere' => $filiere,
            'year' => $currentYear,
            'studentsWithMarks' => $studentsWithMarks,
            'coordinator' => $coordinator,
        ];
        if ($format == 'pdf') {
            $pdf = PDF::loadView('coordinator.export.marks_pdf', $data);
            return $pdf->download("{$class->name}_{$module->name}.pdf");
        } elseif ($format == 'csv') {
            return Excel::download(new MarksExport($studentsWithMarks), "{$class->name}_{$module->name}.csv");
        }
         elseif ($format == 'excel') {
            return Excel::download(new MarksExport($studentsWithMarks), "{$class->name}_{$module->name}.xlsx");
        }
    }
}
