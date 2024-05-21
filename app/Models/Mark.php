<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'module_id', 'type', 'mark'];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(SubjectModel::class);
    }
}
