<?php

namespace App\Models;
use Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DocumentModel extends Model
{
    use HasFactory;
    protected $table = 'document';

    static public function getSingle($id){
        return self::find($id); 
    }
    static public function getRecord(){
        $return = DocumentModel::select('document.*','class.name as class_name', 'subject.name as subject_name', 'users.name as teacher_name')
        ->join('users', 'users.id', '=', 'document.teacher_id')
        ->join('class', 'class.id', '=', 'document.class_id')
        ->join('subject', 'subject.id', '=', 'document.module_id');
        
        if (!empty(Request::get('class_id'))) {
           $return =$return->where('class.id','like','%'.Request::get('class_id').'%');
        }
        if (!empty(Request::get('subject_id'))) {
            $return =$return->where('subject.id','like','%'.Request::get('subject_id').'%');
        }
        if (!empty(Request::get('title'))) {
            $return =$return->where('document.title','like','%'.Request::get('title').'%');
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('document.created_at','=',Request::get('date'));       
         }
        $return = $return->orderBy('document.id', 'desc')
                         ->paginate(20);
        return $return;
    }
     public function getDocument(){
        if(!empty($this->document) && file_exists('upload/document/'.$this->document)){
            return url('upload/document/'.$this->document);
        }
        else
        {
            return "";
        }
    }
    static public function MyDocument($class_id){
        $return = DocumentModel::select('document.*','class.name as class_name', 'subject.name as subject_name', 'users.name as teacher_name', 'users.last_name as teacher_last_name')
        ->join('users', 'users.id', '=', 'document.teacher_id')
        ->join('class', 'class.id', '=', 'document.class_id')
        ->join('subject', 'subject.id', '=', 'document.module_id')
        ->where('document.class_id','=',$class_id);
        
       
        if (!empty(Request::get('teacher_id'))) {
            $return =$return->where('users.id','like','%'.Request::get('teacher_id').'%');
        }
        if (!empty(Request::get('subject_id'))) {
            $return =$return->where('subject.id','like','%'.Request::get('subject_id').'%');
        }
        if (!empty(Request::get('title'))) {
            $return =$return->where('document.title','like','%'.Request::get('title').'%');
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('document.created_at','=',Request::get('date'));       
         }
        $return = $return->orderBy('document.id', 'desc')
                         ->paginate(20);
        return $return;
    }

}
