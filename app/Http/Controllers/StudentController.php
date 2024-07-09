<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Str;
use Auth;
use Hash;
use App\Models\Mark;

use App\Models\User;
use App\Models\ClassModel;
use App\Models\Notification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['classes'] = ClassModel::getClass();
        $data['header_title'] = 'Liste des etudiants';
        return view('admin.student.list',$data);
    }
    public function add(){
       
        $data['getClass'] = ClassModel::getClass();
        
        $data['header_title'] = 'Ajouter nouveau eleve';
        return view('admin.student.add',$data);
    }
    public function insert(Request $request){
        request()->validate([
            'email' =>'required|email|unique:users',
            'mobile_number'=>'max:15|min:10|unique:users',
            'CIN'=>'max:15|unique:users',
            'CNE'=>'max:10|unique:users',


        
        ]);
      
        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->CIN = trim($request->CIN);
        $student->CNE = trim($request->CNE);
        $student->class_id =trim($request->class_id) ;
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);

        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $student->profile_pic = $filename;
        }    
        
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        }
       
        
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        
        $student->save();
        return redirect('admin/student/list')->with('success',"l'étudiant a été créé avec succès");
    }
    public function edit($id){
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = 'Modifier étudiant';
            return view('admin.student.edit',$data);
        }
        else {
            abort(404);
        }

        
    }
    public function update($id, Request $request){
        request()->validate([
            'email' =>'required|email|unique:users,email,'.$id,
            'mobile_number'=>'max:15|min:10',
            'CIN'=>'max:12',
            'CNE'=>'max:10',


        
        ]);
      
        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->CIN = trim($request->CIN);
        $student->CNE = trim($request->CNE);
        $student->class_id = trim($request->class_id) ;
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);

        }
        if(!empty($request->file('profile_pic'))) {
              if(!empty($student->getProfile()))
              {
                unlink('upload/profile/'.$student->profile_pic);
              }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $student->profile_pic = $filename;
        }    
        
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        }
       
        
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password)){
            $student->password = Hash::make($request->password);

        }
        
        
        $student->save();
        return redirect('admin/student/list')->with('success',"l'étudiant a été mis à jour avec succès");

    }
    public function delete($id)  {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord)){
            $getRecord->is_deleted = 1;
            $getRecord->save();
            return redirect()->back()->with('success',"l'étudiant a été supprimé avec succès");

           
        }
        else {
            abort(404);
        }
        
    }
    public function showMarks()
    {
        $studentId = Auth::id();
        $marks = Mark::where('student_id', $studentId)
            ->join('subject', 'marks.module_id', '=', 'subject.id')
            ->select('subject.name as module_name', 'marks.midterm', 'marks.final_exam', 'marks.total')
            ->get();
            $totalMarksSum = $marks->sum('total');
            $marksCount = $marks->count();
            $averageTotalMark = $marksCount > 0 ? $totalMarksSum / $marksCount : 0;
            $notifications = Auth::user()->notifications()->where('read', false)->get();
            $unreadCount = $notifications->count();
           

        return view('student.my-marks', compact('marks','averageTotalMark','unreadCount','notifications'));
    }
    public function downloadMarksPdf()
    {
        $studentId = Auth::id();
        $data['marks'] = Mark::where('student_id', $studentId)
            ->join('subject', 'marks.module_id', '=', 'subject.id')
            ->select('subject.name as module_name', 'marks.midterm', 'marks.final_exam', 'marks.total')
            ->get();
        
        $data['student'] = Auth::user();
        $data['class'] = SubjectModel::find($data['student']->class_id);

        $totalMarksSum = $data['marks']->sum('total');
        $marksCount = $data['marks']->count();
        $data['averageTotalMark'] = $marksCount > 0 ? $totalMarksSum / $marksCount : 0;
        
        $pdf = PDF::loadView('student.marks_pdf', $data);

        return $pdf->download('mes_notes.pdf');
    }
    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        $notification->read = true;
        $notification->save();
        
        return redirect()->back();
    }
}
