<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class DepartmentHeadEnseignantsController extends Controller
{
    public function index()
    {
        $data['header_title'] = "Liste des enseignants de département";
        $departmentId = Auth::user()->department_id;
        $data['enseignants'] = User::where('department_id', $departmentId)
                                    ->where('user_type', 2)
                                    ->paginate(10);
        
        return view('department_head.enseignants.index', $data);
    }

    public function create()
    {
        $data['header_title'] = "Ajouter un enseignant";
        return view('department_head.enseignants.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $departmentId = Auth::user()->department_id;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'), // Set default password or let admin set it
            'department_id' => $departmentId,
            'user_type' => 2, 
        ]);

        return redirect()->route('department_head.enseignants.index')->with('success', 'Enseignant ajouté avec succès');
    }

    public function edit($id)
    {
        $data['header_title'] = "Modifier un enseignant";
        $data['enseignant'] = User::where('id', $id)->where('user_type', 2)->firstOrFail();
        return view('department_head.enseignants.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $enseignant = User::where('id', $id)->where('user_type', 2)->firstOrFail();
        $enseignant->update($request->only('name', 'email'));

        return redirect()->route('department_head.enseignants.index')->with('success', 'Enseignant mis à jour avec succès');
    }

    public function destroy($id)
    {
        $enseignant = User::where('id', $id)->where('user_type', 2)->firstOrFail();
        $enseignant->delete();

        return redirect()->route('department_head.enseignants.index')->with('success', 'Enseignant supprimé avec succès');
    }
}
