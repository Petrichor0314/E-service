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
        $data['header_title'] = "Assign Subject To Teacher";

        return view('admin.assign_subject_teacher.list',$data);
    }

    public function add(Request $request)
    {

        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getTeacher'] = User::getTeacherSubject();
        $data['header_title'] = "Assign Subject To Teacher";
        return view('admin.assign_subject_teacher.add',$data);
    }

    public function insert(Request $request)
{
    if(!empty($request->class_id)){
        
        // Check if the subject is already assigned to a teacher
/*         $existingAssignment = AssignSubjectTeacherModel::where('subject_id', $request->subject_id)->first();
 */
        /* // If subject is already assigned to a teacher, return error
        if ($existingAssignment) {
            return redirect('admin/assign_subject_teacher/list')->with('error', 'Subject is already assigned to a teacher.');
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

        

        return redirect('admin/assign_subject_teacher/list')->with('success', 'Subject Successfully Assigned to Teacher');
    } else {
        return redirect('admin/assign_subject_teacher/list')->with('error', 'Something Went Wrong, Please Try Again!');
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

        $data['header_title'] = "Edit Assignment";
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

        return redirect('admin/assign_subject_teacher/list')->with('success', 'Subject(s) Successfully Assigned to Teacher');
    }





    public function edit_single($id)
    {
        $assignment = AssignSubjectTeacherModel::findOrFail($id);
        
        $data['assignment'] = $assignment;
        $data['getSubject'] = SubjectModel::all();
        $data['getClass'] = ClassModel::all();
        $data['getTeacher'] = User::getTeacherSubject();

        $data['header_title'] = "Edit Assignment";
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

        return redirect('admin/assign_subject_teacher/list')->with('success', 'Assignment Updated Successfully.');
    }

    public function Delete($id)
{
    $assignment = AssignSubjectTeacherModel::findOrFail($id);

    $assignment->is_deleted = 1;

    $assignment->save();

    return redirect('admin/assign_subject_teacher/list')->with('success', 'Assignment Deleted Duccessfully.');
}




}
