<?php

namespace App\Http\Controllers;
use App\Models\DepartementModel;
use App\Models\FiliereModel;
use App\Models\User;

use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function list()
    {
        
        $data['filieres'] = FiliereModel::getFilieres();
        $data['header_title'] = 'Filières';

        return view('admin.filiere.list',$data);
    }
    public function add()
    {
        $data['departements'] = DepartementModel::getDepartements();
        $data['teachers'] = User::getNonCoords();
        $data['header_title'] = "Ajouter un département";
        return view('admin.filiere.add',$data);
    }

    public function edit($id)
    {
        $data['filiere'] = FiliereModel::getById($id);
        $data['departements'] = DepartementModel::getDepartements();
        $data['teachers'] = User::getPotentialCoord();
        if(!empty($data['filiere'])){
            
            $data['header_title'] = "Modifier une filière";
            return view('admin.filiere.edit',$data);
        }
        else{
            abort(404);
        }

    }

    public function update(Request $request, $id)
{
        $filiere = FiliereModel::findOrFail($id);
        $filiere->name = $request->name;
        $filiere->departements_id = $request->departement_id;
        $filiere->coord = $request->coord_id;
        $filiere->save();

    return redirect('admin/filiere/list')->with('success', 'Filière mise à jour avec succès.');
}


    public function insert(Request $request)
    {
        $filiere = new FiliereModel();
        $filiere->name = $request->name;
        $filiere->departements_id = $request->departement_id;
        $filiere->coord = $request->coord_id;
        $filiere->save();

        return redirect('admin/filiere/list')->with('success', 'Filière ajoutée avec succès.');
    }

    public function delete($id)
    {
        $filiere = FiliereModel::findOrFail($id);
        $filiere->delete();

        return redirect('admin/filiere/list')->with('success', 'Filière supprimée avec succès.');
    }
}
