<?php

namespace App\Http\Controllers;

use App\Models\DepartementModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Auth;

class DepartmentHeadModulesController extends Controller
{
    public function index(Request $request)
    {
        $data['header_title'] = "Liste des modules de département";
        $departmentId = Auth::user()->department_id;
        
        $name = $request->input('name');
        $date = $request->input('date');

        $query = SubjectModel::where('department_id', $departmentId)->where('subject.is_deleted','=',0)->with('creator');

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $data['modules'] = $query->paginate(10);

        $data['modules']->appends($request->all());

        return view('departement_head.modules.index', $data);
    }
    public function searchModules(Request $request)
    {
        $departmentId = Auth::user()->department_id;
        
        $name = $request->input('name');
        $date = $request->input('date');

        $query = SubjectModel::where('department_id', $departmentId)
                            ->where('is_deleted', 0)
                            ->with('creator');

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $modules = $query->get()->map(function ($module) {
            return [
                'id' => $module->id,
                'name' => $module->name,
                'creator' => $module->creator,
                'created_at' => date('m-d-Y H:i A', strtotime($module->created_at)),
                'updated_at' => date('m-d-Y H:i A', strtotime($module->updated_at)),
            ];
        });

        return response()->json($modules);
    }
    public function create()
    {
        $departmentId = Auth::user()->department_id;
        $department = DepartementModel::findOrFail($departmentId);
        $data['filieres'] = $department->filieres;
        $data['header_title'] = "Ajouter nouveau module";
        return view('departement_head.modules.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'filieres' => 'required|array', // Assuming 'filieres' is the name of the input field for filières
        ]);
        
        $module = SubjectModel::create([
            'name' => trim($request->name),
            'department_id' => Auth::user()->department_id,
            'status' => trim($request->status),
            'created_by' => Auth::user()->id
        ]);

        $module->filieres()->attach($request->filieres);

        return redirect()->route('department_head.modules.index')->with('success', 'Module ajouté avec succès.');
    }

    public function edit($id)
    {
        $data['header_title'] = "Modifier module";
        $departmentId = Auth::user()->department_id;
        $department = DepartementModel::findOrFail($departmentId);
        $data['filieres'] = $department->filieres;
        $data['module'] = SubjectModel::findOrFail($id);
        
        return view('departement_head.modules.edit', $data);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'filiere_id' => 'array', 
        'filiere_id.*' => 'exists:filieres,id'
    ]);

    $subject = SubjectModel::findOrFail($id);
    $subject->update([
        'name' => trim($request->name),
        'department_id' => Auth::user()->department_id,
        'status' => trim($request->status),
        'created_by' => Auth::user()->id
    ]);

    if ($request->has('filiere_id')) {
        $subject->filieres()->sync($request->filiere_id);
    } else {
        $subject->filieres()->detach();
    }

    return redirect()->route('department_head.modules.index')->with('success', 'Module Màj avec succès.');
}

    public function destroy($id)
    {
        $subject = SubjectModel::findOrFail($id);
        $subject->is_deleted = 1;
        $subject->save();
        return redirect()->route('department_head.modules.index')->with('success', 'Module supprimé avec succès.');
    }
}
