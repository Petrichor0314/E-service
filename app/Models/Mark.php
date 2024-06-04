<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'module_id',
        'teacher_id',
        'midterm',
        'final_exam',
        'total',
        'year',
    ];

    // Define relationships if needed
    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class); 
    }

    public function module()
    {
        return $this->belongsTo(SubjectModel::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
