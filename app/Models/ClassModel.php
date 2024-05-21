<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    public function filiere()
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }
    public function modules()
    {
        return $this->belongsToMany(SubjectModel::class, 'class_teacher_module', 'class_id', 'module_id')
                    ->withPivot('teacher_id');
    }

        public function teachers()
    {
        return $this->belongsToMany(User::class, 'class_teacher_module', 'class_id', 'teacher_id');
    }
    public function students()
    {
        return $this->hasMany(User::class);
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
            ->where('class.status','=',0)
            ->orderBy('class.id','asc')
            ->get();
            
            return $return;
        }
        public static function getCLassByIds($class_ids)
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


   



