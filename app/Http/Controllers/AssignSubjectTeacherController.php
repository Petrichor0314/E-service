<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\User;
use App\Models\ClassSubjectModel;
use App\Models\AssignSubjectTeacherModel;
use Auth;

class AssignSubjectTeacherController extends Controller
{
    public function list(){
        $data['getRecord'] = AssignSubjectTeacherModel::getRecord();
        $data['classes'] = ClassModel::getClass();
        $data['subjects'] = SubjectModel::getSubject();
        $data['teachers'] = User::getTeacher();
        $data['header_title'] = "Assigner un module à un enseignant";

        return view('admin.assign_subject_teacher.list',$data);
    }

    public function add(Request $request)
    {

        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getTeacher'] = User::getTeacherSubject();
        $data['header_title'] = "Assigner un module à un enseignant";
        return view('admin.assign_subject_teacher.add',$data);
    }

    public function insert(Request $request)
{
    if(!empty($request->class_id)){
        
        // Vérifier si le sujet est déjà assigné à un enseignant
/*         $existingAssignment = AssignSubjectTeacherModel::where('subject_id', $request->subject_id)->first();
 */
        /* // Si le sujet est déjà assigné à un enseignant, renvoyer une erreur
        if ($existingAssignment) {
            return redirect('admin/assign_subject_teacher/list')->with('error', 'Le sujet est déjà assigné à un enseignant.');
        }
        else
        { */
            foreach($request->class_id as $class_id)
            {   
                
                {
                    $assignment = new AssignSubjectTeacherModel;
                    $assignment->teacher_id = $request->teacher_id;
                    $assignment->subject_id = $request->subject_id;
                    $assignment->class_id = $class_id; 
                    $assignment->status = $request->status;
                    $assignment->created_by = Auth::user()->id;
                    $assignment->save();

                }

            }

        

        return redirect('admin/assign_subject_teacher/list')->with('success', 'Le sujet a été assigné avec succès à un enseignant.');
    } else {
        return redirect('admin/assign_subject_teacher/list')->with('error', 'Quelque chose s\'est mal passé, veuillez réessayer !');
    }
}

    public function edit($id)
    {
        $assignment = AssignSubjectTeacherModel::findOrFail($id);
        $data['assignment'] = $assignment;
        $data['getSubject'] = SubjectModel::all();
        $data['getClass'] = ClassModel::all();
        $data['getTeacher'] = User::getTeacherSubject();

        $assignedClasses = AssignSubjectTeacherModel::where('subject_id', $assignment->subject_id)
            ->where('teacher_id', $assignment->teacher_id)
            ->pluck('class_id')
            ->toArray();

        $data['assignedClasses'] = $assignedClasses;

        $data['header_title'] = "Modifier l'assignment";
        return view('admin.assign_subject_teacher.edit', $data);
    }

    public function update(Request $request)
    {

        AssignSubjectTeacherModel::where('subject_id', $request->subject_id)
            ->where('teacher_id', $request->teacher_id)
            ->delete();

        if (!empty($request->class_id)) {
            foreach ($request->class_id as $class_id) {   

                $assignment = new AssignSubjectTeacherModel;
                $assignment->teacher_id = $request->teacher_id;
                $assignment->subject_id = $request->subject_id;
                $assignment->class_id = $class_id;
                $assignment->status = $request->status;
                $assignment->created_by = Auth::user()->id;
                $assignment->save();
            }
        }

        return redirect('admin/assign_subject_teacher/list')->with('success', 'Le(s) sujet(s) a(ont) été assigné(s) avec succès à un enseignant.');
    }





    public function edit_single($id)
    {
        $assignment = AssignSubjectTeacherModel::findOrFail($id);
        
        $data['assignment'] = $assignment;
        $data['getSubject'] = SubjectModel::all();
        $data['getClass'] = ClassModel::all();
        $data['getTeacher'] = User::getTeacherSubject();

        $data['header_title'] = "Modifier l'assignment";
        return view('admin.assign_subject_teacher.edit_single', $data);
    }


    public function update_single(Request $request, $id)
    {
        $assignment = AssignSubjectTeacherModel::findOrFail($id);
        $assignment->teacher_id = $request->teacher_id;
        $assignment->class_id = $request->class_id;
        $assignment->subject_id = $request->subject_id;
        $assignment->status = $request->status;
        $assignment->created_by = Auth::user()->id;
        $assignment->save();

        return redirect('admin/assign_subject_teacher/list')->with('success', 'L\'assignment a été mise à jour avec succès.');
    }

    public function Delete($id)
{
    $assignment = AssignSubjectTeacherModel::findOrFail($id);

    $assignment->is_deleted = 1;

    $assignment->save();

    return redirect('admin/assign_subject_teacher/list')->with('success', 'L\'assignment a été supprimé avec succès.');
}




}

