<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiliereModel extends Model
{
    use HasFactory;

    protected $table = 'filieres';

    protected $fillable = ['coord','name'];


    static public function getById($id){
        return self::find($id);
    }

    static public function getHeads(){

        return User::whereIn('id', DepartementModel::pluck('head'))->get();
 
    }

    static protected function getFilieres(){
        $return = FiliereModel::select('filieres.*', 'users.name as coord_name','users.last_name as coord_last_name','departements.name as departement_name')
                ->join('users', 'users.id', '=', 'filieres.coord')
                ->join('departements', 'departements.id', '=', 'filieres.departements_id')
                ->get();
    
        return $return;
    }
}
