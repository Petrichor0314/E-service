<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SubjectModel extends Model
    {
        use HasFactory;
        protected $table = 'subject';

        protected $fillable = [
            'name',
            'department_id',
            'created_by',
        ];

        
        public function teachers()
        {
            return $this->belongsToMany(User::class, 'class_teacher_module', 'module_id', 'teacher_id');
        }

        public function classes()
        {
            return $this->belongsToMany(ClassModel::class, 'class_teacher_module', 'module_id', 'class_id')
                        ->withPivot('teacher_id');
        }

        public function filieres()
        {
            return $this->belongsToMany(FiliereModel::class, 'filiere_module', 'module_id', 'filiere_id');
        }


        public function creator()
        {
            return $this->belongsTo(User::class, 'created_by');
        }



        static public function getSingle($id){

            return self::find($id);

        }
        static public function getRecord()
        {
            $return = SubjectModel::select('subject.*', 'users.name as created_by_name')
                    ->join('users', 'users.id', 'subject.created_by');

                    if(!empty(Request::get('name'))){
                        $return = $return->where('subject.name','like','%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('type'))){
                        $return = $return->where('subject.type','=',Request::get('type'));
                    }
                    if(!empty(Request::get('date'))){
                        $return = $return->whereDate('subject.created_at','=','%'.Request::get('date'));
                    }
                    
                    $return=$return->where('subject.is_deleted','=',0)
                                    ->orderBy('subject.id', 'desc')
                                    ->paginate(20);

            return $return;
        }

        static public function getSubject()
        {
            $return = SubjectModel::select('subject.*')
                                    ->join('users', 'users.id', 'subject.created_by')
                                    ->where('subject.is_deleted','=',0)
                                    ->where('subject.status','=',0)
                                    ->orderBy('subject.name', 'asc')
                                    ->get();

            return $return;
        }
        public static function getSubjectByIds($subject_ids)
        {
            $subjects = SubjectModel::select('id', 'name')
                                    ->whereIn('id', $subject_ids)
                                    ->where('is_deleted', '=', 0)
                                    ->where('status', '=', 0)
                                    ->get()
                                    ->pluck('name', 'id')
                                    ->toArray();
        
            return $subjects;
        }
       
        static public function getTotalSubject()
        {
            
        return self:: where('subject.is_deleted','=',0)
                    ->where('subject.status','=',0)
                    ->count();

        
        }
        static public function getSubjectNameById($id)
{
           $subject = SubjectModel::select('name')
                           ->where('id', $id)
                           ->where('is_deleted', 0)
                           ->where('status', 0)
                           ->first();

           return $subject ? $subject->name : null;
}
    }
