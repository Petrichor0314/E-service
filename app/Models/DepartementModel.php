<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DepartementModel extends Model
{
    use HasFactory;
    protected $table = 'departements';

    protected $fillable = ['head','name'];

    public function head()
    {
        return $this->belongsTo(User::class, 'head');
    }

    static public function getById($id){
        return self::find($id);
    }

    static public function getHeads(){

        return User::whereIn('id', DepartementModel::pluck('head'))->get();
 
    }

    static protected function getDepartements(){
        $return = DepartementModel::select('departements.*', 'users.name as head_name','users.last_name as head_last_name')
                ->join('users', 'users.id', '=', 'departements.head')
                ->get();
    
        return $return;
    }
    

}
