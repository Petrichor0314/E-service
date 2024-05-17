<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimetableModel extends Model
{
    use HasFactory;
    protected $table = 'class_subject_timetable';
    //start from here
    static public function getRecordClassSubject($class_id,$subject_id,$week_id,$session_type)
    {
        return self::where('class_id','=',$class_id)->where('subject_id','=',$subject_id)->where('week_id','=',$week_id)->where('session_type','=',$session_type)->first();
    }
    static public function getRecordClassSubjectByTeacher($subject_id,$teacher_id,$week_id,$session_type)
    {
        return self::where('subject_id','=',$subject_id)->where('teacher_id','=',$teacher_id)->where('week_id','=',$week_id)->where('session_type','=',$session_type)->first();
    }

    public static function getSessionTypes($classId, $subjectId, $weekId)
{
    return self::where('class_id', $classId)
        ->where('subject_id', $subjectId)
        ->where('week_id', $weekId)
        ->distinct('session_type')
        ->pluck('session_type')
        ->toArray();
}
public static function deleteByClassSubjectSession($class_id, $subject_id, $session_type)
{
                            self::where('class_id', $class_id)
                                ->where('subject_id', $subject_id)
                                ->where('session_type', $session_type)
                                ->delete();
}
public static function getSubjectIdsByTeacherId($teacher_id)
{
    $records = self::where('teacher_id', $teacher_id)
                   
                   ->distinct('subject_id')
                   ->pluck('subject_id');

    return $records->toArray();
}
public static function deleteRecordStart($class_id, $week_id, $start_time)
{
    self::where('class_id', '=', $class_id)
        ->where('week_id', '=', $week_id)
        ->where('start_time', '=', $start_time)
        ->delete();
}
public static function deleteRecordEnd($class_id, $week_id, $end_time)
    {
        self::where('class_id', '=', $class_id)
            ->where('week_id', '=', $week_id)
            ->where('end_time', '=', $end_time)
            ->delete();
    }
    public static function deleteRecord($class_id, $week_id, $start_time,$end_time)
    {
        self::where('class_id', '=', $class_id)
            ->where('week_id', '=', $week_id)
            ->where('start_time', '=', $start_time)
            ->where('end_time', '=', $end_time)
            ->delete();
    }    
}
