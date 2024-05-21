<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\Mark;
use Hash;
use Auth;
use Str;

class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = 'Teacher List';
        return view('admin.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Teacher';
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
            'marital_status' => 'max:50',
        ]);

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

        /*      $teacher->address = trim($request->address);   */
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->CIN = trim($request->CIN);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', 'Teacher Successfully Created');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Teacher';
            return view('admin.teacher.edit', $data);
        } else {
            abort(404);
        }
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
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', 'Teacher Successfully Updated');
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_deleted = 1;
            $getRecord->save();

            return redirect()->back()->with('success', 'Teacher Successfully Deleted');
        } else {
            abort(404);
        }
    }

    public function showMarksForm()
    {
        $teacher = Auth::user();
        $classes = $teacher->classes()->with('modules')->get()->unique('id');

        return view('teacher.marks.index', compact('classes'));
    }

    public function getModules(Request $request)
    {
        $classId = $request->input('class_id');
        $modules = SubjectModel::where('class_id', $classId)->get();
        dd($modules);
        return response()->json(['modules' => $modules]);
    }

    public function getStudentsAndMarks(Request $request)
    {
        $classId = $request->input('class_id');
        $moduleId = $request->input('module_id');
        $students = User::where('class_id', $classId)->get();

        $studentsWithMarks = $students->map(function($student) use ($moduleId) {
            $midterm = Mark::where('student_id', $student->id)->where('module_id', $moduleId)->where('type', 'midterm')->first();
            $final = Mark::where('student_id', $student->id)->where('module_id', $moduleId)->where('type', 'final')->first();
            $total = $midterm && $final ? ($midterm->mark * 0.4) + ($final->mark * 0.6) : null;

            return [
                'id' => $student->id,
                'name' => $student->name,
                'midterm' => $midterm ? $midterm->mark : null,
                'final' => $final ? $final->mark : null,
                'total' => $total,
            ];
        });

        return response()->json(['students' => $studentsWithMarks]);
    }

    public function storeMarks(Request $request)
    {
        $marks = $request->input('marks');

        foreach ($marks as $studentId => $markData) {
            Mark::updateOrCreate(
                ['student_id' => $studentId, 'module_id' => $request->input('module_id'), 'type' => 'midterm'],
                ['mark' => $markData['midterm']]
            );

            Mark::updateOrCreate(
                ['student_id' => $studentId, 'module_id' => $request->input('module_id'), 'type' => 'final'],
                ['mark' => $markData['final']]
            );
        }

        return redirect()->route('teacher.marks.index')->with('success', 'Marks saved successfully.');
    }
}
