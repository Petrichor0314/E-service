<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceModel extends Model
{
    use HasFactory;
    protected $table ='attendance';
    static function CheckAlreadyAttendance($student_id,$subject_id,$class_id,$start_time,$end_time,$attendance_date){
        return StudentAttendanceModel::where('student_id','=',$student_id)
                                      ->where('subject_id','=',$subject_id)
                                      ->where('class_id','=',$class_id)
                                      ->where('start_time','=',$start_time)
                                      ->where('end_time','=',$end_time)
                                      ->where('attendance_date','=',$attendance_date)
                                      ->first();

    }
}
