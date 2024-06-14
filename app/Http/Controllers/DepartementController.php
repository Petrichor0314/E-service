<?php

namespace App\Http\Controllers;

use App\Models\DepartementModel;
use App\Models\User;
use Illuminate\Http\Request;

class DepartementController extends Controller
{

    public function list()
    {
        
        $data['departements'] = DepartementModel::getDepartements();
        $data['heads'] = DepartementModel::getHeads();
        $data['header_title'] = 'Départements';

        return view('admin.departement.list',$data);
    }
    public function add()
    {
        $data['teachers'] = User::getNonHeads();
        $data['header_title'] = "Ajouter un département";
        return view('admin.departement.add',$data);
    }

    public function edit($id)
    {
        $data['departement'] = DepartementModel::getById($id);
        $data['teachers'] = User::getTeacherAndAdmins();
        if(!empty($data['departement'])){
            
            $data['header_title'] = "Modifier un chef de département";
            return view('admin.departement.edit',$data);
        }
        else{
            abort(404);
        }

    }

    public function update($id,Request $request){
        $departement = DepartementModel::getById($id);
        $departement->name = $request->name;
        if(!empty($request->head_id)){
            $departement->head = $request->head_id;
        }
        $departement->save();

        return redirect('admin/departement/list')->with('success', 'Mise à jour réussie.');
    }

    public function insert(Request $request)
    {

        $departement = new DepartementModel();
        $departement->name = $request->name;
        $departement->head = $request->head_id;
        $departement->save();

        return redirect('admin/departement/list')->with('success', 'Département ajouté avec succès.');
    }

    public function delete($id)
{
    try {
        $department = DepartementModel::findOrFail($id);
        $department->delete();

        return redirect()->back()->with('success', 'Département supprimé avec succès.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Echec de la suppression du département. ' . $e->getMessage());
    }
}


}

