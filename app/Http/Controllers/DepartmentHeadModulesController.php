<?php

namespace App\Http\Controllers;

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

    public function create()
    {
        $data['header_title'] = "Ajouter nouveau module";
        return view('departement_head.modules.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        SubjectModel::create([
            'name' => trim($request->name),
            'department_id' => Auth::user()->department_id,
            'status' => trim($request->status),
            'created_by' => Auth::user()->id
           
        ]);

        return redirect()->route('department_head.modules.index')->with('success', 'Module ajouté avec succès.');
    }

    public function edit($id)
    {
        $data['module'] = SubjectModel::findOrFail($id);
        $data['header_title'] = "Modifier module";
        
        return view('departement_head.modules.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject = SubjectModel::findOrFail($id);
        $subject->update([
            'name' => trim($request->name),
            'department_id' => Auth::user()->department_id,
            'status' => trim($request->status),
            'created_by' => Auth::user()->id
        ]);

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
