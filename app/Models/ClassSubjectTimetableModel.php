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
    public static function getSessionTypes($classId, $subjectId, $weekId)
{
    return self::where('class_id', $classId)
        ->where('subject_id', $subjectId)
        ->where('week_id', $weekId)
        ->distinct('session_type')
        ->pluck('session_type')
        ->toArray();
}
}
