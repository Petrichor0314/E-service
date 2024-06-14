<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\AssignSubjectTeacherModel;
use Illuminate\Http\Request;
use Auth;

class SubjectController extends Controller
{
    public function list(){
        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] = "Liste des modules";
        return view('admin.subject.list',$data);
    }

    public function add(){
        $data['header_title'] = "Ajouter un nouveau module";
        return view('admin.subject.add',$data);
    }

    public function insert(Request $request){
        $save = new SubjectModel;
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/subject/list')->with('success','Le sujet a été créé avec succès');
    }

    public function edit($id)
    {

        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Modifier Module";
            return view('admin.subject.edit', $data);
        }
        else
        {
        abort(404); 
        }
    }


    public function update($id,Request $request)
    {

        $save = SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/subject/list')->with('success','Le sujet a été mis à jour avec succès');
    }

    public function delete($id)
    {
        $save = SubjectModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();

        return redirect()->back()->with('success','Le sujet a été supprimé avec succès');
    }
    //student part
    public function MySubject(){
        $data['getRecord'] = AssignSubjectTeacherModel::MySubject(Auth::user()->class_id);
        $data['header_title'] = "Mes modules ";
        return view('student.my_subject',$data);

    }
}
