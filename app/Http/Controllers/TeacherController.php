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
        $teacherId = auth()->id();
    
        $modules = User::find($teacherId)
            ->modules()
            ->wherePivot('class_id', $classId)
            ->get();

        return response()->json(['modules' => $modules]);
    }

    public function getStudentsAndMarks(Request $request)
    {
        $classId = $request->input('class_id');
        $moduleId = $request->input('module_id');
        
        // Fetch students with class_id and user_type 3
        $students = User::where('class_id', $classId)
                        ->where('user_type', 3)
                        ->where('is_deleted', 0)
                        ->orderBy('name', 'asc')
                        ->get();

        $studentsWithMarks = $students->map(function($student) use ($moduleId) {
            $mark = Mark::where('student_id', $student->id)
                        ->where('module_id', $moduleId)
                        ->first();

            return [
                'id' => $student->id,
                'name' => $student->name,
                'last_name' => $student->last_name,
                'midterm' => $mark ? $mark->midterm : null,
                'final' => $mark ? $mark->final_exam : null,
                'total' => $mark ? $mark->total : null,
            ];
        });

        return response()->json(['students' => $studentsWithMarks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class,id',
            'module_id' => 'required|exists:subject,id',
            'midterm.*' => 'nullable|numeric|min:0|max:20',
            'final_exam.*' => 'nullable|numeric|min:0|max:20',
        ]);
    
        $classId = $request->input('class_id');
        $moduleId = $request->input('module_id');
        $teacherId = Auth::id();
        $currentYear = date('Y'); // Get the current year
    
        if (!$currentYear) {
            return redirect()->back()->withErrors('Current year is not set.');
        }
    
        foreach ($request->input('midterm', []) as $studentId => $midterm) {
            $finalExam = $request->input("final_exam.$studentId");
            $total = null;
    
            if ($midterm !== null && $finalExam !== null) {
                $total = round(($midterm * 0.4) + ($finalExam * 0.6), 2);
            }
    
            $mark = Mark::where('student_id', $studentId)
                        ->where('class_id', $classId)
                        ->where('module_id', $moduleId)
                        ->where('teacher_id', $teacherId)
                        ->where('year', $currentYear)
                        ->first();
    
            if ($mark) {
                // Update existing mark
                $mark->update([
                    'midterm' => $midterm,
                    'final_exam' => $finalExam,
                    'total' => $total,
                ]);
            } else {
                // Create new mark record
                Mark::create([
                    'student_id' => $studentId,
                    'class_id' => $classId,
                    'module_id' => $moduleId,
                    'teacher_id' => $teacherId,
                    'year' => $currentYear,
                    'midterm' => $midterm,
                    'final_exam' => $finalExam,
                    'total' => $total,
                ]);
            }
        }
    
        return redirect()->route('teacher.marks.index')->with('success', 'Marks have been successfully saved.');
    }
    

}
