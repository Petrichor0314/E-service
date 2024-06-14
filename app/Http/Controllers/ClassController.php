<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;

use App\Models\FiliereModel;
use Illuminate\Http\Request;
use Auth;

class ClassController extends Controller
{
    public function list(){
        $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] = "Liste des classes";
        return view('admin.class.list',$data);
    }

    public function add(){
        $data['header_title'] = "Ajouter une nouvelle classe";
        $data['filieres'] = FiliereModel::getFilieres();
        return view('admin.class.add',$data);
    }

    public function insert(Request $request)
    {
        $save = new ClassModel;
        $save->name = $request->name;
        $save->status = $request->status;
        $save->filiere_id = $request->filiere_id;
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/class/list')->with('success', "Classe ajoutée avec succès");
    }

    public function edit($id)
    {

        $data['getRecord'] = ClassModel::getSingle($id);
        $data['filieres'] = FiliereModel::getFilieres();
        $data['class'] = ClassModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Modifier la classe";
            return view('admin.class.edit', $data);
        }
        else
        {
        abort(404); 
        }
    }

    public function update($id, Request $request)
    {

        $save = ClassModel::getSingle($id);
        $save->name = $request->name;
        $save->filiere_id = $request->filiere_id;
        $save->status = $request->status;
        $save->save();

        return redirect('admin/class/list')->with('success', "Classe mise à jour avec succès");

    }

    public function delete($id){

        $save = ClassModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();

        return redirect()->back()->with('success', "Classe supprimée avec succès");

    }

}




