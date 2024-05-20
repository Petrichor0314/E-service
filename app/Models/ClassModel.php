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
    static public function getClassName($id)
    {
       
            // Retrieve the class name based on the class_id
            $class = self::find($id);
    
            // Check if the class exists
            if ($class) {
                // Assuming the class name is stored in a "name" column
                return $class->name;
            }
    
            return null; // or throw an exception or handle the error case
        
    }
    static public function getRecord()
    {
        $return = ClassModel::select('class.*', 'users.name as created_by_name')
                ->join('users', 'users.id', 'class.created_by');

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
<<<<<<< HEAD
         }
        static public function getClass(){
            $return = ClassModel::select('class.*')
            
            ->join('users','users.id','class.created_by')
            ->where('class.is_deleted','=',0)
            ->where('class.status','=',0)
            ->orderBy('class.id','asc')
            ->get();
            
            return $return;
        }
        public static function getCLassByIds($class_ids)
=======
    }
   


    static public function getClass()
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
    {
        $subjects = ClassModel::select('id', 'name')
                                ->whereIn('id', $class_ids)
                                ->where('is_deleted', '=', 0)
                                ->where('status', '=', 0)
                                ->get()
                                ->pluck('name', 'id')
                                ->toArray();
    
        return $subjects;
    }
    }


   



