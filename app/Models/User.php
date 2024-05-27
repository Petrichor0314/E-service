<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\StudentAttendanceModel;
use App\Models\DepartementModel;
use App\Models\SubjectModel;
use App\Models\Mark;

use Illuminate\Support\Facades\DB;
use Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass asssignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function filieres()
    {
        return $this->hasMany(FiliereModel::class, 'coord'); 
    }
     public function classes()
     {
         return $this->belongsToMany(ClassModel::class, 'class_teacher_module', 'teacher_id', 'class_id')
                     ->withPivot('module_id');
     }
     public function modules()
     {
         return $this->belongsToMany(SubjectModel::class, 'class_teacher_module', 'teacher_id', 'module_id');
     }
     

     public function department()
    {
        return $this->belongsTo(DepartementModel::class);
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getAdmin()
    {
        $return = self::select('users.*')
                        ->where('user_type','=',1)
                        ->where('is_deleted','=',0);
                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('name','like','%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('email','like','%'.Request::get('email').'%');
                        }
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('created_at','=',Request::get('date'));
                        }

        $return = $return->orderBy('id','desc')
                         ->paginate(3);
        return $return;
    }
    static function getStudentClass($class_id){
       $return = self::select('users.id','users.name','users.last_name')
                 ->where('users.user_type','=',3)
                 ->where('users.is_deleted','=',0)
                 ->where('users.class_id','=',$class_id)
                 ->orderBy('users.id','desc')
                 ->get();
       return $return;

    }
    public static function getStudentsClass($class_id)
{
    $return = User::select('id', 'name', 'last_name')
        ->where('user_type', '=', 3)
        ->where('is_deleted', '=', 0)
        ->whereIn('class_id', $class_id)
        ->get()
        ->toArray();

    return $return;
}
    static public function getStudent()
    {
        $return = self::select('users.*','class.name as class_name')
                        ->join('class','class.id','=','users.class_id','left')
                        ->where('users.user_type','=',3)
                        ->where('users.is_deleted','=',0);
                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('users.name','like','%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('last_name')))
                        {
                            $return = $return->where('users.last_name','like','%'.Request::get('last_name').'%');
                        }
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email','like','%'.Request::get('email').'%');
                        }
                        if(!empty(Request::get('CIN')))
                        {
                            $return = $return->where('users.CIN','like','%'.Request::get('CIN').'%');
                        }
                        if(!empty(Request::get('CNE')))
                        {
                            $return = $return->where('users.CNE','like','%'.Request::get('CNE').'%');
                        }
                        if(!empty(Request::get('class')))
                        {
                            $return = $return->where('class.name','like','%'.Request::get('class').'%');
                        }
                        if(!empty(Request::get('gender')))
                        {
                            $status = (Request::get('gender') == 'male') ? 'Male' : 'Female';
                            $return = $return->where('users.gender','=',$status);
                        }
                        if(!empty(Request::get('mobile_number')))
                        {
                            $return = $return->where('users.mobile_number','like','%'.Request::get('mobile_number').'%');
                        }
                        if(!empty(Request::get('admission_date')))
                        {
                            $return = $return->whereDate('users.admission_date','=',Request::get('admission_date'));
                        }
                        if(!empty(Request::get('date_of_birth')))
                        {
                            $return = $return->whereDate('users.date_of_birth','=',Request::get('date_of_birth'));
                        }
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('users.created_at','=',Request::get('date'));
                        }
                        if(!empty(Request::get('status')))
                        {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->where('users.status','=',$status);
                        }

        $return = $return->orderBy('users.id','desc')
                         ->paginate(20);
        return $return;
    }

    static public function getTeacher(){

        $return = self::select('users.*')
                        ->where('users.user_type', '=', 2) 
                        ->where('users.is_deleted', '=', 0);

                        if (!empty(Request::get('name'))) {
                            $return->where('users.name', 'like', '%' . Request::get('name') . '%');
                        }

                        if (!empty(Request::get('last_name'))) {
                            $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
                        }
                        if (!empty(Request::get('email'))) {
                            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
                        }
                        
                        if (!empty(Request::get('gender'))) {
                            $return = $return->where('users.gender', '=', Request::get('gender'));
                        }
                        
                        if (!empty(Request::get('mobile_number'))) {
                            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
                        }
                        
                        if (!empty(Request::get('marital_status'))) {
                            $return = $return->where('users.marital_status', 'like', '%' . Request::get('marital_status') . '%');
                        }
                        
                        if (!empty(Request::get('address'))) {
                            $return = $return->where('users.address', 'like', '%' . Request::get('address') . '%');
                        }
                        
                        if (!empty(Request::get('admission_date'))) {
                            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
                        }
                        
                        if (!empty(Request::get('date'))) {
                            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
                        }
                        
                        if (!empty(Request::get('status'))) {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->where('users.status', '=', $status);
                        }

                $return = $return->orderBy('users.id','desc')
                                ->paginate(20);
                        
            return $return;
        
    }

    static public function getNonHeads(){
        $subquery = DepartementModel::select('head')->get()->pluck('head')->toArray();
    
        $nonHeads = User::whereNotIn('id', $subquery)
                        ->whereIn('user_type', [1, 2])
                        ->get();
    
        return $nonHeads;
    }
    static public function getNonCoords(){
        $return = self::select('users.*')
            ->where(function($query) {
                $query->where('users.user_type', '=', 2) 
                    ->orWhere('users.user_type', '=', 1);
            })
            ->where('users.is_deleted', '=', 0)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('filieres')
                    ->whereColumn('filieres.coord', 'users.id');
            })
            ->orderBy('users.id', 'desc')
            ->get();
    
        return $return;
    }
    
    static public function getTeacherAndAdmins(){
        $return = self::select('users.*')
                        ->where(function($query) {
                            $query->where('users.user_type', '=', 2) 
                                ->orWhere('users.user_type', '=', 1);
                        })
                        ->whereNotIn('users.id', function($query) {
                            $query->select('head')
                                ->from('departements');
                        })
                        ->where('users.is_deleted', '=', 0)
                        ->orderBy('users.id','desc')
                        ->get();
        return $return;
    }

    static public function getPotentialCoord(){
        $return = self::select('users.*')
                        ->where(function($query) {
                            $query->where('users.user_type', '=', 2) 
                                ->orWhere('users.user_type', '=', 1);
                        })
                        ->where('users.is_deleted', '=', 0)
                        ->orderBy('users.id','desc')
                        ->get();
        return $return;
    }
    

    
    static public function getTeacherSubject(){

        $return = self::select('users.*')
                        ->where('users.user_type', '=', 2) 
                        ->where('users.is_deleted', '=', 0);

                        /* if (!empty(Request::get('name'))) {
                            $return->where('users.name', 'like', '%' . Request::get('name') . '%');
                        }

                        if (!empty(Request::get('last_name'))) {
                            $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
                        }
                        if (!empty(Request::get('email'))) {
                            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
                        }
                        
                        if (!empty(Request::get('gender'))) {
                            $return = $return->where('users.gender', '=', Request::get('gender'));
                        }
                        
                        if (!empty(Request::get('mobile_number'))) {
                            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
                        }
                        
                        if (!empty(Request::get('marital_status'))) {
                            $return = $return->where('users.marital_status', 'like', '%' . Request::get('marital_status') . '%');
                        }
                        
                        if (!empty(Request::get('address'))) {
                            $return = $return->where('users.address', 'like', '%' . Request::get('address') . '%');
                        }
                        
                        if (!empty(Request::get('admission_date'))) {
                            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
                        }
                        
                        if (!empty(Request::get('date'))) {
                            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
                        }
                        
                        if (!empty(Request::get('status'))) {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->where('users.status', '=', $status);
                        } */

                $return = $return->orderBy('users.id','desc')
                                ->get();
                        
            return $return;
        
    }

    static public function getEmailSingle($email)
    {
        return User::where('email','=',$email)->first();
    }
    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token','=',$remember_token)->first();
    }
    public function getProfile()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
            
        }
        else{
            return "";
        }
    }
    static function getAttendance($student_id,$subject_id,$class_id,$start_time,$end_time,$attendance_date){
        return StudentAttendanceModel::CheckAlreadyAttendance($student_id,$subject_id,$class_id,$start_time,$end_time,$attendance_date);
    }
  
}
