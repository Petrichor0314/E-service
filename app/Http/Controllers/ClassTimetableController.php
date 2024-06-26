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

    public function getEndTimes(Request $request)
{
    $startTime = $request->input('start_time');

    // Determine available end times based on the selected start time
    $endTimes = [];

    // Logic to determine available end times based on the selected start time
    if ($startTime === '08:30') {
        $endTimes = ['10:30', '12:30'];
    } elseif ($startTime === '10:30') {
        $endTimes = ['12:30'];
    } elseif ($startTime === '14:30') {
        $endTimes = ['16:30', '18:30'];
    } elseif ($startTime === '16:30') {
        $endTimes = ['18:30'];
    }

    return response()->json(['end_times' => $endTimes]);
}
    public function list(Request $request){

        $coordinateur = Auth::user(); 
        $data['getClass']= $coordinateur->filieres()->with('classes')->get();
        if(!empty($request->class_id)){
            $data['getSubject']=AssignSubjectTeacherModel::MySubject($request->class_id);
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
        $data['header_title'] = "Horaire de la classe ";
        //START
         $result = array();
    $getRecord = AssignSubjectTeacherModel::MySubject($request->class_id);

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
                    $value->module_id,
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
        return redirect()->back()->with('success', "La session a été supprimée");

    }
    public function get_subject(Request $request){
        $getSubject=AssignSubjectTeacherModel::MySubject($request->class_id);

        $html = "<option value=''>Sélectionnez</option>";
        foreach($getSubject as $value)
        {
            $html .= "<option value='".$value->module_id."'>".$value->subject_name."</option>";
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
                return redirect()->back()->with('error', "veuillez fournir toutes les informations importantes");
            }
            foreach ($request->timetable as $timetable) {
                
            if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['session_type']))
            {
                // Find existing entry based on class, subject, week, and session type (unchanged)
                $existingEntry = ClassSubjectTimetableModel::where('class_id', $request->class_id)
                                                            ->where('subject_id', $request->subject_id)       
                                                            ->where('week_id', $timetable['week_id'])    
                                                            ->where('session_type', $timetable['session_type'])
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
                    $existingEntryProblem_0 = ClassSubjectTimetableModel::where('class_id', $request->class_id)
                                                                        ->where('week_id', $timetable['week_id'])    
                                                                        ->where('start_time', $timetable['start_time'])
                                                                        ->Where('end_time', $timetable['end_time'])  
                                                                        ->first();
                    $existingEntryProblem = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                    ->where('class_id','!=', $request->class_id)
                    ->where('week_id', $timetable['week_id'])    
                ->where('start_time', $timetable['start_time'])
                ->Where('end_time', $timetable['end_time'])  
                    ->first();
                    $existingEntryProblem_2 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                    ->where('class_id','!=', $request->class_id)
                    ->where('week_id', $timetable['week_id'])
                    ->where('start_time', $timetable['start_time'])          
                    ->first();
                    $existingEntryProblem_3 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                    ->where('class_id','!=', $request->class_id)
                    ->where('week_id', $timetable['week_id'])
                    ->where('end_time', $timetable['end_time'])          
                    ->first();
                    $existingEntryProblem_4 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                    ->where('class_id','!=', $request->class_id)
                    ->where('week_id', $timetable['week_id'])
                    ->where('start_time','!=', $timetable['start_time']) 
                    ->where('end_time', $timetable['end_time'])         
                ->first();
                $existingEntryProblem_5 = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                ->where('class_id','!=', $request->class_id)
                ->where('week_id', $timetable['week_id'])
                ->where('start_time', $timetable['start_time'])          
                ->where('end_time','!=', $timetable['end_time'])
                ->first(); 
            
                
                                                                                                        
                if($existingEntryProblem || ( $existingEntryProblem_2 &&  $existingEntryProblem_3) || ($existingEntryProblem_4 ||  $existingEntryProblem_5)){
                    return redirect()->back()->with('error', "L'enseignant n'est pas disponible");
                }
                    
                if ($existingEntry) {
                    
            
                    if($existingEntryProblem_0){
                        ClassSubjectTimetableModel::deleteRecord($existingEntryProblem_0->class_id,$existingEntryProblem_0->week_id,$existingEntryProblem_0->start_time,$existingEntryProblem_0->end_time);
                    }
                    if($existingEntry_2 && $existingEntry_3)
                {
                    ClassSubjectTimetableModel::deleteRecordStart($existingEntry_2->class_id,$existingEntry_2->week_id,$existingEntry_2->start_time);
                    ClassSubjectTimetableModel::deleteRecordEnd($existingEntry_2->class_id,$existingEntry_2->week_id,$existingEntry_2->end_time);
                }
                if($existingEntry_4 || $existingEntry_5)
                {
                    if($existingEntry_4){
                        ClassSubjectTimetableModel::deleteRecord($existingEntry_4->class_id,$existingEntry_4->week_id,$existingEntry_4->start_time,$existingEntry_4->end_time);
                    }
                    else{
                        ClassSubjectTimetableModel::deleteRecord($existingEntry_5->class_id,$existingEntry_5->week_id,$existingEntry_5->start_time,$existingEntry_5->end_time);
    
                    }
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
                    return redirect()->back()->with('success', "La session a été mise à jour avec succès");
                
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
                    return redirect()->back()->with('success', "La session a été mise à jour avec succès");
                        


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
                    return redirect()->back()->with('success', "La session a été mise à jour avec succès");

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
                return redirect()->back()->with('success', "La session a été enregistrée avec succès");

                }
            }
            
        }
        
            
        }
    //student side
    // version
    public function MyTimetable()
{
    $result = array();
    $getRecord = AssignSubjectTeacherModel::MySubject(Auth::user()->class_id);
    
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
                    $value->module_id,
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

    $getClassName = ClassModel::getClassName(Auth::user()->class_id);
    $data['getClassName'] = $getClassName;
    $data['getRecord'] = $result;
    $data['header_title'] = "My Timetable ";
     
    return view('student.my_timetable',$data);
}
public function CLassTimetable(Request $request){
    $result = array();
    $getRecord = AssignSubjectTeacherModel::MySubject(Request::get('class_id'));

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
