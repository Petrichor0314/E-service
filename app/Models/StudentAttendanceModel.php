<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceModel extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'subject_id',
        'class_id',
        'start_time',
        'end_time',
        'attendance_date',
        'created_by',
        'student_id',
        'first_name',
        'last_name',
        'attendance_type'
    ];

    /**
     * Check if attendance already exists for a given student and class details.
     */
    public static function CheckAlreadyAttendance($student_id, $subject_id, $class_id, $start_time, $end_time, $attendance_date)
    {
        return self::where('student_id', $student_id)
            ->where('subject_id', $subject_id)
            ->where('class_id', $class_id)
            ->where('start_time', $start_time)
            ->where('end_time', $end_time)
            ->where('attendance_date', $attendance_date)
            ->first();
    }

    /**
     * Retrieve attendance records with optional filters.
     */
    public static function getRecord($class_id = null, $subject_id = null, $student_id = null, $attendance_date = null, $attendance_type = null)
    {
        $query = self::select(
            'attendance.student_id',
            'attendance.first_name',
            'attendance.last_name',
            'class.name as class_name',
            'subject.name as subject_name',
            'attendance.attendance_date',
            'attendance.start_time',
            'attendance.end_time',
            'attendance.attendance_type'
        )
        ->join('class', 'attendance.class_id', '=', 'class.id')
        ->join('subject', 'attendance.subject_id', '=', 'subject.id');

        if (!empty($class_id)) {
            $query->where('attendance.class_id', $class_id);
        }
        if (!empty($subject_id)) {
            $query->where('attendance.subject_id', $subject_id);
        }
        if (!empty($student_id)) {
            $query->where('attendance.student_id', $student_id);
        }
        if (!empty($attendance_date)) {
            $query->where('attendance.attendance_date', $attendance_date);
        }
        if (!empty($attendance_type)) {
            $query->where('attendance.attendance_type', $attendance_type);
        }

        return $query->get()->toArray();
    }
}
