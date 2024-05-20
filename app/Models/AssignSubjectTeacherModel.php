<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class AssignSubjectTeacherModel extends Model
{
    use HasFactory;

    protected $table = 'subject_teacher';

    

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
        $query = self::select('subject_teacher.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as teacher_name')
                    ->join('subject', 'subject.id', '=', 'subject_teacher.subject_id')
                    ->join('class', 'class.id', '=', 'subject_teacher.class_id')
                    ->join('users', 'users.id', '=', 'subject_teacher.teacher_id')
                    ->where('subject_teacher.is_deleted', '=', 0);
    
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
            $query->whereDate('subject_teacher.created_at', '=', Request::get('date'));
        }
    
        $query->orderBy('subject_teacher.id', 'desc');
    
        $records = $query->paginate(20);
    
        return $records;
    }


    static public function getAssignClassID($subject_id)
    {
        return self::where('subject_id','=',$subject_id)
                    ->where('is_deleted','=',0)
                    ->get();
    }

    public static function getTeacherIDBySubjectID($subject_id)
{
    $record = self::where('subject_id', $subject_id)
        ->where('is_deleted', 0)
        ->first();

    if ($record) {
        return $record->teacher_id;
    }

    return null;
}


    static public function getAlreadyFirst($teacher_id , $subject_id){
        return self::where('teacher_id','=',$teacher_id)
                    ->where('subject_id','=',$subject_id)
                    ->first();
    }
    public static function getSubjectIdByTeacherId($teacher_id){
           $return = self::select('subject_teacher.subject_id')
                        ->where('teacher_id','=', $teacher_id)
                       ->where('is_deleted', 0)
                       ->get();
          return $return;             
    }
    public static function getClassIdByTeacherId($teacher_id){
        $return = self::select('subject_teacher.class_id')
                     ->where('teacher_id','=', $teacher_id)
                    ->where('is_deleted', 0)
                    ->distinct()
                    ->get();
       return $return;             
 }
}
