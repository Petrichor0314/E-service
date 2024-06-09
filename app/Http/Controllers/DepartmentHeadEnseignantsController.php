<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Str;
use Hash;

class DepartmentHeadEnseignantsController extends Controller
{
    public function index(Request $request)
{
        $data['header_title'] = "Liste des enseignants de département";
        $departmentId = Auth::user()->department_id;

        $query = User::with('department')
                    ->where('department_id', $departmentId)
                    ->where('user_type', 2);

        if ($request->has('name')) {
            $name = $request->input('name');
            $query->where(function($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%')
                ->orWhere('last_name', 'like', '%' . $name . '%');
            });
        }

        if ($request->input('last_name')) {
            $query->where('last_name', 'like', '%' . $request->input('last_name') . '%');
        }

        if ($request->input('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->input('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->input('mobile_number')) {
            $query->where('mobile_number', 'like', '%' . $request->input('mobile_number') . '%');
        }

        if ($request->input('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->input('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $data['enseignants'] = $query->paginate(10);

    return view('departement_head.enseignants.index', $data);
}
public function searchEnseignants(Request $request)
{
    $departmentId = Auth::user()->department_id;
    
    $query = User::with('department')
                ->where('department_id', $departmentId)
                ->where('user_type', 2);

    if ($request->has('name')) {
        $name = $request->input('name');
        $query->where(function($q) use ($name) {
            $q->where('name', 'like', '%' . $name . '%')
              ->orWhere('last_name', 'like', '%' . $name . '%');
        });
    }

    if ($request->input('last_name')) {
        $query->where('last_name', 'like', '%' . $request->input('last_name') . '%');
    }

    if ($request->input('email')) {
        $query->where('email', 'like', '%' . $request->input('email') . '%');
    }

    if ($request->input('gender')) {
        $query->where('gender', $request->input('gender'));
    }

    if ($request->input('mobile_number')) {
        $query->where('mobile_number', 'like', '%' . $request->input('mobile_number') . '%');
    }

    if ($request->input('status')) {
        $query->where('status', $request->input('status'));
    }

    if ($request->input('date')) {
        $query->whereDate('created_at', $request->input('date'));
    }

    $enseignants = $query->get()->map(function ($enseignant) {
        return [
            'id' => $enseignant->id,
            'profile' => $enseignant->getProfile(),
            'name' => $enseignant->name,
            'last_name' => $enseignant->last_name,
            'email' => $enseignant->email,
            'gender' => $enseignant->gender,
            'department' => $enseignant->department->name,
            'mobile_number' => $enseignant->mobile_number,
            'status' => $enseignant->status,
            'created_at' => date('m-d-Y H:i A', strtotime($enseignant->created_at)),
        ];
    });

    return response()->json($enseignants);
}

    public function create()
    {
        $data['header_title'] = "Ajouter un enseignant";
        return view('departement_head.enseignants.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $departmentId = Auth::user()->department_id;

        $teacher = new User();
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->admission_date)) {
            $teacher->admission_date = trim($request->admission_date);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->CIN = trim($request->CIN);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->department_id = $departmentId;
        $teacher->save();

        return redirect()->route('department_head.enseignants.index')->with('success', 'Enseignant ajouté avec succès');
    }

    public function edit($id)
    {
        $data['header_title'] = "Modifier un enseignant";
        $data['enseignant'] = User::where('id', $id)->where('user_type', 2)->firstOrFail();
        return view('departement_head.enseignants.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
            'marital_status' => 'max:50',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->admission_date)) {
            $teacher->admission_date = trim($request->admission_date);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        /*      $teacher->address = trim($request->address);   */
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->CIN = trim($request->CIN);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->input('password'));
        }
        $teacher->user_type = 2;
        $teacher->save();

        return redirect()->route('department_head.enseignants.index')->with('success', 'Teacher Successfully Updated');
    }

    public function destroy($id)
    {
        $enseignant = User::where('id', $id)->where('user_type', 2)->firstOrFail();
        $enseignant->delete();

        return redirect()->route('department_head.enseignants.index')->with('success', 'Enseignant supprimé avec succès');
    }
}
