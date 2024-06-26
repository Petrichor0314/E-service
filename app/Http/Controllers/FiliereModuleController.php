<?php

namespace App\Http\Controllers;

use App\Models\DepartementModel;
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
        
        $filiereIds = $filieres->pluck('id');

        // Get all module IDs assigned to these filieres
        $filiereModuleIds = DB::table('filiere_module')
                            ->whereIn('filiere_id', $filiereIds)
                            ->pluck('module_id');


        // Get the actual module data
        $modules = SubjectModel::whereIn('id', $filiereModuleIds)->get();
       
        // Get all teachers of the same department
        $teachers = User::where('department_id', $coordinateur->department_id)
                        ->where('user_type', 2)
                        ->get();

        return view('coordinator.modules.index', compact('filieres', 'modules', 'teachers'));
    }


    public function storeAssignments(Request $request)
{
    // Validate the request data
    $request->validate([
        'class_id' => 'required|exists:class,id',
        'module_id' => 'required|exists:subject,id',
        'teacher_id' => 'required|exists:users,id',
    ]);

    // Check if the combination of class_id and module_id exists
    $assignment = DB::table('class_teacher_module')
                    ->where('class_id', $request->class_id)
                    ->where('module_id', $request->module_id)
                    ->first();

    if ($assignment) {
        // If the record exists, update the teacher_id and timestamps
        DB::table('class_teacher_module')
            ->where('class_id', $request->class_id)
            ->where('module_id', $request->module_id)
            ->update([
                'teacher_id' => $request->teacher_id,
                'updated_at' => now(),
            ]);
    } else {
        // If the record does not exist, insert a new one
        DB::table('class_teacher_module')->insert([
            'class_id' => $request->class_id,
            'module_id' => $request->module_id,
            'teacher_id' => $request->teacher_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Redirect with a success message
    return redirect()->route('coordinateur.modules.index')->with('success', 'Les assignations ont été mises à jour avec succès.');
}

}
