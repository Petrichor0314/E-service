<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    public function subjects()
    {
    return $this->belongsToMany(SubjectModel::class, 'class_subject', 'class_id', 'subject_id');
    }

    static public function getSingle($id){

        return self::find($id);

    }
    static public function getRecord()
    {
        $return = ClassModel::select('class.*', 'users.name as created_by_name','filieres.name as filiere_name')
                ->join('users', 'users.id', 'class.created_by')
                ->join('filieres', 'filieres.id', 'class.filiere_id');

                if(!empty(Request::get('name'))){
                    $return = $return->where('class.name','like','%'.Request::get('name').'%');
                }
                if(!empty(Request::get('date'))){
                    $return = $return->whereDate('class.created_at','=','%'.Request::get('date'));
                }
                $return=$return->where('class.is_deleted','=',0)
                                ->orderBy('class.id', 'desc')
                                ->paginate(20);

        return $return;
         }
        static public function getClass(){
            $return = ClassModel::select('class.*')
            
            ->join('users','users.id','class.created_by')
            ->where('class.is_deleted','=',0)
            ->where('class.status','=',1)
            ->orderBy('class.id','asc')
            ->get();
            
            return $return;
        }
    }


   



