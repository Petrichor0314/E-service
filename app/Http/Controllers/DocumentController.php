<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignSubjectTeacherModel;
use App\Models\ClassModel;
use App\Models\DocumentModel;
use App\Models\Notification;
use Auth;
use App\Models\User;
use Str;

class DocumentController extends Controller  
{

 public function list(){

    $data['header_title'] = "Liste des documents"; 
    $data['getClass']= AssignSubjectTeacherModel::MyClassTeacher(Auth::user()->id);
    $data['getRecord'] = DocumentModel::getRecord();
    return view('teacher.document.list',$data);
 }
 public function MyDocument(){

   $data['header_title'] = "Mes Documents";  
   $data['getSubject']= AssignSubjectTeacherModel::MySubject(Auth::user()->class_id);
  
   $data['getTeacher']= AssignSubjectTeacherModel::MyTeachers(Auth::user()->class_id);
  
   
   $data['getRecord'] = DocumentModel::MyDocument(Auth::user()->class_id);
   $notifications = Auth::user()->notifications()->where('read', false)->get();
   $unreadCount = $notifications->count();
   $data['unreadCount'] = $unreadCount;
   $data['notifications'] = $notifications;
   return view('student.document.list',$data);
}
 public function add(){
   $data['header_title'] = "ajoute nouveau document"; 
   $data['getClass']= AssignSubjectTeacherModel::MyClassTeacher(Auth::user()->id);
  
    return view('teacher.document.add',$data);
 }
 public function get_subject(Request $request){
   $getSubject=AssignSubjectTeacherModel::MySubject($request->class_id);

   $html = "<option value=''>Sélectionner</option>";
   foreach($getSubject as $value)
   {
       $html .= "<option value='".$value->module_id."'>".$value->subject_name."</option>";
   }
   $json['html'] = $html;
   echo json_encode($json);
}
  public function insert(Request $request){
   $document = new DocumentModel;
   $document->teacher_id = Auth::user()->id;
   $document->class_id = trim($request->class_id);
   $document->module_id = trim($request->subject_id); 
   if(!empty($request->file('document'))){
      $ext = $request->file('document')->getClientOriginalExtension();
      $file = $request->file('document');
      $randomStr = Str::random(20);
      $filename = strtolower($randomStr).'.'.$ext;
      $file->move('upload/document/',$filename);
      $document->document = $filename;
  }      
   $document->title = trim($request->title);
   $document->description = trim($request->description);
   $document->save();
   $students = User::where('class_id', $document->class_id)->where('user_type','=',3)->get();
  

   foreach ($students as $student) { 
       
       Notification::create([
           'user_id' => $student->id,
           'message' => 'Un nouveau document a été envoyé .',
       ]);
   }



   return redirect('teacher/document/list')->with('success', "Document ajouté avec succès");
  }
  public function edit($id){
   $getRecord = DocumentModel::getSingle($id);
   $data['getRecord'] = $getRecord;
   $data['getClass']= AssignSubjectTeacherModel::MyClassTeacher(Auth::user()->id);
   $data['getSubject']=AssignSubjectTeacherModel::MySubject($getRecord->class_id);  
   
   $data['header_title'] = "Modifier document"; 
    return view('teacher.document.edit',$data);
  }
  public function update(Request $request,$id){
   $document = DocumentModel::getSingle($id);
   $document->class_id = trim($request->class_id);
   $document->module_id = trim($request->subject_id); 
   if(!empty($request->file('document'))){
      $ext = $request->file('document')->getClientOriginalExtension();
      $file = $request->file('document');
      $randomStr = Str::random(20);
      $filename = strtolower($randomStr).'.'.$ext;
      $file->move('upload/document/',$filename);
      $document->document = $filename;
  }      
   $document->title = trim($request->title);
   $document->description = trim($request->description);
   $document->save();
   return redirect('teacher/document/list')->with('success', "Document modifier avec succès");
  }
  public function delete($id){
   $document = DocumentModel::getSingle($id);
   $document->delete();
   return redirect('teacher/document/list')->with('success', "Document supprimé avec succès");
  }
}
