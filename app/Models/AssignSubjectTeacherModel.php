<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class AssignSubjectTeacherModel extends Model
{
    use HasFactory;

    protected $table = 'class_teacher_module';

    

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function subject()
    {
        return $this->belongsTo(SubjectModel::class);
    }

    public function classes()
    {
        return $this->subject->classes();
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord(){
        $query = self::select('class_teacher_module.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as teacher_name')
                    ->join('subject', 'subject.id', '=', 'class_teacher_module.module_id')
                    ->join('class', 'class.id', '=', 'class_teacher_module.class_id')
                    ->join('users', 'users.id', '=', 'class_teacher_module.teacher_id');
    
        if(!empty(Request::get('class'))) {
            $query->where('class.name', 'like', '%' . Request::get('class') . '%');
        }
    
        if(!empty(Request::get('subject'))) {
            $query->where('subject.name', 'like', '%' . Request::get('subject') . '%');
        }
    
        if(!empty(Request::get('teacher'))) {
            $query->where('users.name', 'like', '%' . Request::get('teacher') . '%');
        }
    
        if(!empty(Request::get('date'))) {
            $query->whereDate('class_teacher_module.created_at', '=', Request::get('date'));
        }
    
        $query->orderBy('class_teacher_module.id', 'desc');
    
        $records = $query->paginate(20);
    
        return $records;
    }


    static public function getAssignClassID($subject_id)
    {
        return self::where('module_id','=',$subject_id)
                    ->get();
    }

    public static function getTeacherIDBySubjectID($subject_id)
{
    $record = self::where('module_id', $subject_id)
                   ->first();

    if ($record) {
        return $record->teacher_id;
    }

    return null;
}


    static public function getAlreadyFirst($teacher_id , $subject_id){
        return self::where('teacher_id','=',$teacher_id)
                    ->where('module_id','=',$subject_id)
                    ->first();
    }
    public static function getSubjectIdByTeacherId($teacher_id){
           $return = self::select('class_teacher_module.module_id')
                        ->where('teacher_id','=', $teacher_id)
                       ->get();
          return $return;             
    }
    public static function getClassIdByTeacherId($teacher_id){
        $return = self::select('class_teacher_module.class_id')
                     ->where('teacher_id','=', $teacher_id)
                    ->distinct()
                    ->get();
       return $return;             
 }
 static public function MySubject($class_id){
    return  self::select('class_teacher_module.*','subject.name as subject_name','subject.type as subject_type')
    ->join('subject','subject.id','=','class_teacher_module.module_id')
    ->join('class','class.id','=','class_teacher_module.class_id')
    ->where('class_teacher_module.class_id','=',$class_id)
    ->orderBy('class_teacher_module.id','desc')
    ->get();
  

   }
   static public function ClassSubject($subject_id){
    return  self::select('class_teacher_module.*','class.name as class_name','class.id as class_id')
    ->join('subject','subject.id','=','class_teacher_module.module_id')
    ->join('class','class.id','=','class_teacher_module.class_id')
    ->where('class_teacher_module.module_id','=',$subject_id)
    ->orderBy('class_teacher_module.id','desc')
    ->get();

   }
}
