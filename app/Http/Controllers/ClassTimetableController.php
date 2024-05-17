<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\WeekModel;
use App\Models\ClassSubjectTimetableModel;
use App\Models\AssignSubjectTeacherModel;
use App\Models\SubjectModel;
use Auth;

class ClassTimetableController extends Controller
{
    public function list(Request $request){
        $data['getClass']=ClassModel::getClass();
        if(!empty($request->class_id)){
            $data['getSubject']=ClassSubjectModel::MySubject($request->class_id);
            $data['getClassName']=ClassModel::getClassName($request->class_id);
        }
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach($getWeek as $value)
        {
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;
            //hnaa bdit
            if(!empty($request->class_id) && !empty($request->subject_id) && !empty($request->session_type) ){
                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($request->class_id,$request->subject_id,$value->id,$request->session_type);
                if(!empty($ClassSubject)){
                    $dataW['start_time'] = $ClassSubject->start_time;
                    $dataW['end_time'] = $ClassSubject->end_time;
                    $dataW['session_type'] = $ClassSubject->session_type;
                    $dataW['amphi_name'] = $ClassSubject->amphi_name;
                    $dataW['bloc_name'] = $ClassSubject->bloc_name;
                    $dataW['room_number'] = $ClassSubject->room_number;

                }
                else{
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['session_type'] = '';
                    $dataW['amphi_name'] = '';
                    $dataW['bloc_name'] = '';
                    $dataW['room_number'] = '';
                }
            }
            else {
                $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['session_type'] = '';
                    $dataW['amphi_name'] = '';
                    $dataW['bloc_name'] = '';
                    $dataW['room_number'] = '';
            }
            
            $week[] = $dataW;
        }
         $data['week'] = $week;
        $data['header_title'] = "Class timetable ";
        //START
         $result = array();
    $getRecord = ClassSubjectModel::MySubject($request->class_id);

    foreach ($getRecord as $value) {
        $dataS['name'] = $value->subject_name;

        $getWeek = WeekModel::getRecord();
        $week = array();

        $sessionTypes = ["TD", "COURS", "TP"]; // Array of all possible session types

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            foreach ($sessionTypes as $sessionType) {
                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject(
                    $value->class_id,
                    $value->subject_id,
                    $valueW->id,
                    $sessionType
                );

                if (!empty($ClassSubject)) {
                    $dataW['start_time'][$sessionType] = $ClassSubject->start_time;
                    $dataW['end_time'][$sessionType] = $ClassSubject->end_time;
                    $dataW['session_type'][$sessionType] = $ClassSubject->session_type;
                    $dataW['amphi_name'][$sessionType] = $ClassSubject->amphi_name;
                    $dataW['bloc_name'][$sessionType] = $ClassSubject->bloc_name;
                    $dataW['room_number'][$sessionType] = $ClassSubject->room_number;
                } else {
                    $dataW['start_time'][$sessionType] = '';
                    $dataW['end_time'][$sessionType] = '';
                    $dataW['session_type'][$sessionType] = '';
                    $dataW['amphi_name'][$sessionType] = '';
                    $dataW['bloc_name'][$sessionType] = '';
                    $dataW['room_number'][$sessionType] = '';
                }
            }

            $week[] = $dataW;
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }

    $data['getRecord'] = $result;
     
        //END

        return view('admin.class_timetable.list',$data);
    }
    public function delete_session(Request $request){
       
        ClassSubjectTimetableModel::deleteByClassSubjectSession($request->class_id,$request->subject_id,$request->session_type);
        return redirect()->back()->with('success', "Session has been deleted");

    }
    public function get_subject(Request $request){
        $getSubject=ClassSubjectModel::MySubject($request->class_id);
        $html = "<option value=''>Select</option>";
        foreach($getSubject as $value)
        {
            $html .= "<option value='".$value->subject_id."'>".$value->subject_name."</option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
    public function insert_update(Request $request) {
        $t=0;
      
        $TeacherId= AssignSubjectTeacherModel::getTeacherIDBySubjectID($request->subject_id);
        

        foreach($request->timetable as $timetable){
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['session_type'])){
              $t=1;
            }
          }
          if($t==0){
            return redirect()->back()->with('error', "provide all important informations");
          }
        foreach ($request->timetable as $timetable) {
          if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['session_type']))
           {
               // Find existing entry based on class, subject, week, and session type (unchanged)
              $existingEntry = ClassSubjectTimetableModel::where('class_id', $request->class_id)
                                                      ->where('week_id', $timetable['week_id'])    
                                                     ->where('start_time', $timetable['start_time'])
                                                     ->Where('end_time', $timetable['end_time'])  
                                                      ->first();


               $existingEntry_2 = ClassSubjectTimetableModel::where('class_id', $request->class_id)
                                                     ->where('week_id', $timetable['week_id'])
                                                     ->where('start_time', $timetable['start_time'])          
                                                      ->first();
                $existingEntry_3 = ClassSubjectTimetableModel::where('class_id', $request->class_id)
                                                      ->where('week_id', $timetable['week_id'])
                                                      ->where('end_time', $timetable['end_time'])
                                                              
                                                       ->first(); 
        
                $existingEntry_4 = ClassSubjectTimetableModel::where('class_id', $request->class_id)
                                                          ->where('week_id', $timetable['week_id'])
                                                         ->where('start_time','!=', $timetable['start_time']) 
                                                          ->where('end_time', $timetable['end_time'])         
                                                        ->first();
                 $existingEntry_5 = ClassSubjectTimetableModel::where('class_id', $request->class_id)
                     ->where('week_id', $timetable['week_id'])
                     ->where('start_time', $timetable['start_time'])          
                     ->where('end_time','!=', $timetable['end_time'])
                   ->first();    
                
                //TESTT SOLVING PROBLEM
                $existingEntryProblem = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                ->where('week_id', $timetable['week_id'])    
               ->where('start_time', $timetable['start_time'])
               ->Where('end_time', $timetable['end_time'])  
                ->first();
                $existingEntryProblem_2 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                ->where('week_id', $timetable['week_id'])
                ->where('start_time', $timetable['start_time'])          
                ->first();
                $existingEntryProblem_3 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                ->where('week_id', $timetable['week_id'])
                ->where('end_time', $timetable['end_time'])          
                ->first();
                $existingEntryProblem_4 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                ->where('week_id', $timetable['week_id'])
                ->where('start_time','!=', $timetable['start_time']) 
                 ->where('end_time', $timetable['end_time'])         
               ->first();
               $existingEntryProblem_5 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
               ->where('week_id', $timetable['week_id'])
               ->where('start_time', $timetable['start_time'])          
               ->where('end_time','!=', $timetable['end_time'])
             ->first(); 

                                                                                                     
            if($existingEntryProblem || ( $existingEntryProblem_2 &&  $existingEntryProblem_3) || ($existingEntryProblem_4 ||  $existingEntryProblem_5)){
                return redirect()->back()->with('error', "Teacher is not valable");
            }

             if ($existingEntry) {
              // Update existing entry (unchanged)

              $existingEntry->class_id = $request->class_id;
              $existingEntry->subject_id = $request->subject_id;
              $existingEntry->teacher_id = $TeacherId;
              $existingEntry->week_id = $timetable['week_id'];
              $existingEntry->start_time = $timetable['start_time'];
              $existingEntry->end_time = $timetable['end_time'];
              $existingEntry->session_type = $timetable['session_type'];
              $existingEntry->amphi_name = $timetable['amphi_name'];
              $existingEntry->bloc_name = $timetable['bloc_name'];
              $existingEntry->room_number = $timetable['room_number'];
              $existingEntry->save();
              return redirect()->back()->with('success', "Session successfully updated");
            } 
            else if($existingEntry_4 || $existingEntry_5)
            {
                if($existingEntry_4){
                    ClassSubjectTimetableModel::deleteRecord($existingEntry_4->class_id,$existingEntry_4->week_id,$existingEntry_4->start_time,$existingEntry_4->end_time);
                }
                else{
                    ClassSubjectTimetableModel::deleteRecord($existingEntry_5->class_id,$existingEntry_5->week_id,$existingEntry_5->start_time,$existingEntry_5->end_time);
 
                }

                $save = new ClassSubjectTimetableModel;
                $save->class_id = $request->class_id;
                $save->subject_id = $request->subject_id;
                $save->teacher_id = $TeacherId;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->session_type = $timetable['session_type'];
                $save->amphi_name = $timetable['amphi_name'];
                $save->bloc_name = $timetable['bloc_name'];
                $save->room_number = $timetable['room_number'];
                $save->save();
                return redirect()->back()->with('success', "Session successfully updated");
                    


            }
            else if($existingEntry_2 && $existingEntry_3)
            {
                ClassSubjectTimetableModel::deleteRecordStart($existingEntry_2->class_id,$existingEntry_2->week_id,$existingEntry_2->start_time);
                ClassSubjectTimetableModel::deleteRecordEnd($existingEntry_2->class_id,$existingEntry_2->week_id,$existingEntry_2->end_time);
                $save = new ClassSubjectTimetableModel;
                $save->class_id = $request->class_id;
                $save->subject_id = $request->subject_id;
                $save->teacher_id = $TeacherId;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->session_type = $timetable['session_type'];
                $save->amphi_name = $timetable['amphi_name'];
                $save->bloc_name = $timetable['bloc_name'];
                $save->room_number = $timetable['room_number'];
                $save->save();
                return redirect()->back()->with('success', "Session successfully updated");

            }
       
             
            else {
              $save = new ClassSubjectTimetableModel;
              $save->class_id = $request->class_id;
              $save->subject_id = $request->subject_id;
              $save->teacher_id = $TeacherId;
              $save->week_id = $timetable['week_id'];
              $save->start_time = $timetable['start_time'];
              $save->end_time = $timetable['end_time'];
              $save->session_type = $timetable['session_type'];
              $save->amphi_name = $timetable['amphi_name'];
              $save->bloc_name = $timetable['bloc_name'];
              $save->room_number = $timetable['room_number'];
              $save->save();
              return redirect()->back()->with('success', "Session successfully saved");

            }
        }
        
      }
     
         
    }
    //student side
    // version
    public function MyTimetable()
{
    $result = array();
    $getRecord = ClassSubjectModel::MySubject(Auth::user()->class_id);

    foreach ($getRecord as $value) {
        $dataS['name'] = $value->subject_name;

        $getWeek = WeekModel::getRecord();
        $week = array();

        $sessionTypes = ["TD", "COURS", "TP"]; // Array of all possible session types

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            foreach ($sessionTypes as $sessionType) {
                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject(
                    $value->class_id,
                    $value->subject_id,
                    $valueW->id,
                    $sessionType
                );

                if (!empty($ClassSubject)) {
                    $dataW['start_time'][$sessionType] = $ClassSubject->start_time;
                    $dataW['end_time'][$sessionType] = $ClassSubject->end_time;
                    $dataW['session_type'][$sessionType] = $ClassSubject->session_type;
                    $dataW['amphi_name'][$sessionType] = $ClassSubject->amphi_name;
                    $dataW['bloc_name'][$sessionType] = $ClassSubject->bloc_name;
                    $dataW['room_number'][$sessionType] = $ClassSubject->room_number;
                } else {
                    $dataW['start_time'][$sessionType] = '';
                    $dataW['end_time'][$sessionType] = '';
                    $dataW['session_type'][$sessionType] = '';
                    $dataW['amphi_name'][$sessionType] = '';
                    $dataW['bloc_name'][$sessionType] = '';
                    $dataW['room_number'][$sessionType] = '';
                }
            }

            $week[] = $dataW;
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }

    $data['getRecord'] = $result;
    $data['header_title'] = "My Timetable ";
     
    return view('student.my_timetable',$data);
}
public function CLassTimetable(Request $request){
    $result = array();
    $getRecord = ClassSubjectModel::MySubject(Request::get('class_id'));

    foreach ($getRecord as $value) {
        $dataS['name'] = $value->subject_name;

        $getWeek = WeekModel::getRecord();
        $week = array();

        $sessionTypes = ["TD", "COURS", "TP"]; // Array of all possible session types

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            foreach ($sessionTypes as $sessionType) {
                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject(
                    $value->class_id,
                    $value->subject_id,
                    $valueW->id,
                    $sessionType
                );

                if (!empty($ClassSubject)) {
                    $dataW['start_time'][$sessionType] = $ClassSubject->start_time;
                    $dataW['end_time'][$sessionType] = $ClassSubject->end_time;
                    $dataW['session_type'][$sessionType] = $ClassSubject->session_type;
                    $dataW['amphi_name'][$sessionType] = $ClassSubject->amphi_name;
                    $dataW['bloc_name'][$sessionType] = $ClassSubject->bloc_name;
                    $dataW['room_number'][$sessionType] = $ClassSubject->room_number;
                } else {
                    $dataW['start_time'][$sessionType] = '';
                    $dataW['end_time'][$sessionType] = '';
                    $dataW['session_type'][$sessionType] = '';
                    $dataW['amphi_name'][$sessionType] = '';
                    $dataW['bloc_name'][$sessionType] = '';
                    $dataW['room_number'][$sessionType] = '';
                }
            }

            $week[] = $dataW;
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }

    $data['getRecord'] = $result;
    $data['header_title'] = "My Timetable ";
     
    return view('admin.class_timetable.timetable_class',$data);
}
public function MyTimetableTeacher()
{
    $result = array();
   $subjectId_teacher =ClassSubjectTimetableModel::getSubjectIdsByTeacherId(Auth::user()->id);
    $getRecord = SubjectModel::getSubjectByIds($subjectId_teacher);
  
    

    foreach ($getRecord as $subject_id => $value) {
        $dataS['name'] = $value;

        $getWeek = WeekModel::getRecord();
        $week = array();

        $sessionTypes = ["TD", "COURS", "TP"]; // Array of all possible session types

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            foreach ($sessionTypes as $sessionType) {
                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubjectByTeacher($subject_id,Auth::user()->id,$valueW->id, $sessionType);

                if (!empty($ClassSubject)) {
                    $dataW['start_time'][$sessionType] = $ClassSubject->start_time;
                    $dataW['end_time'][$sessionType] = $ClassSubject->end_time;
                    $dataW['session_type'][$sessionType] = $ClassSubject->session_type;
                    $dataW['amphi_name'][$sessionType] = $ClassSubject->amphi_name;
                    $dataW['bloc_name'][$sessionType] = $ClassSubject->bloc_name;
                    $dataW['room_number'][$sessionType] = $ClassSubject->room_number;
                } else {
                    $dataW['start_time'][$sessionType] = '';
                    $dataW['end_time'][$sessionType] = '';
                    $dataW['session_type'][$sessionType] = '';
                    $dataW['amphi_name'][$sessionType] = '';
                    $dataW['bloc_name'][$sessionType] = '';
                    $dataW['room_number'][$sessionType] = '';
                }
            }

            $week[] = $dataW;
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }

    $data['getRecord'] = $result;
    $data['header_title'] = "My Timetable ";
    
     
    return view('teacher.my_timetable',$data);
}

    
}
