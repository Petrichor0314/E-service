<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiliereModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\User;
use Auth;
use DB;

class FiliereModuleController extends Controller
{
    public function index()
    {
        $coordinateur = Auth::user();
        $filieres = $coordinateur->filieres()->with('classes', 'modules')->get();

        return view('coordinator.modules.index', compact('filieres'));
    }

    public function showFilieresModules()
    {
        $coordinateur = Auth::user();
        $filieres = $coordinateur->filieres()->with(['classes', 'modules'])->get();
        return view('coordinator.modules.index', compact('filieres'));
    }
    public function showAssignments()
    {
        $coordinateur = Auth::user();
        $filieres = $coordinateur->filieres()->with('classes')->get();
        // Get all modules of filieres the coordinateur is assigned to
        $modules = SubjectModel::whereIn('department_id', $filieres->pluck('departements_id')->unique())->get();
        // Get all teachers of the same department
        $teachers = User::where('department_id', $coordinateur->department_id)->where('user_type', 2)->get();
        return view('coordinator.modules.index', compact('filieres', 'modules', 'teachers'));
    }


     public function storeAssignments(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class,id',
            'module_id' => 'required|exists:subject ,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        DB::table('class_teacher_module')->updateOrInsert(
            [
                'class_id' => $request->class_id,
                'module_id' => $request->module_id,
                'teacher_id' => $request->teacher_id,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect()->route('coordinateur.modules.index')->with('success', 'Assignments updated successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'module_id' => 'required|exists:subject,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $class = ClassModel::findOrFail($request->class_id);
        $class->modules()->attach($request->module_id, ['teacher_id' => $request->teacher_id]);

        return redirect()->route('coordinateur.modules.index')->with('success', 'Module assigned successfully.');
    }
}