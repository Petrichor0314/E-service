<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\WeekModel;
use App\Models\Notification;
use App\Models\ClassSubjectTimetableModel;
use App\Models\AssignSubjectTeacherModel;
use App\Models\SubjectModel;
use Auth;

    class ClassTimetableController extends Controller
    {



        public function list(Request $request)
        {
            $coordinateur = Auth::user(); 
            $data['getClass'] = $coordinateur->filieres()->with('classes')->get();
            $data['getSubject'] = [];
            $data['getSessions'] = [];
            
            if ($request->has('class_id')) {
                $data['getSubject'] = AssignSubjectTeacherModel::MySubject($request->class_id);
                $data['getSessions'] = ClassSubjectTimetableModel::where('class_id', $request->class_id)->get();
            }
        
            return view('admin.class_timetable.list_2', $data);
        }
        

        public function get_subject(Request $request)
        {
            $getSubject = AssignSubjectTeacherModel::MySubject($request->class_id);
            $getSessions = ClassSubjectTimetableModel::where('class_id', $request->class_id)->get();
        
            $html = "";
            foreach ($getSubject as $value) {
                $html .= "<div class='external-event bg-info' data-subject-id='".$value->module_id."'>".$value->subject_name."</div>";
            }
            
            return response()->json([
                'html' => $html,
                'sessions' => $getSessions->map(function($session) {
                    return [
                        'title' => $session->subject->subject_name,
                        'start' => $session->start_time,
                        'end' => $session->end_time,
                        'subject_id' => $session->subject_id
                    ];
                })
            ]);
        }
        


    public function insert_update(Request $request)
    {
        $data = $request->all();
        
        $timetable = json_decode($data['timetable'], true);
        
        foreach ($timetable as $time) {
            $TeacherId = AssignSubjectTeacherModel::getTeacherIDBySubjectID($time['subject_id']);
        
            $existingEntryProblem = ClassSubjectTimetableModel::where('teacher_id', $TeacherId)
                ->where('class_id', '!=', $data['class_id'])
                ->where('week_id', $time['week_id'])
                ->where('start_time', $time['start_time'])
                ->where('end_time', $time['end_time'])
                ->first();
                $existingEntryProblem_2 = ClassSubjectTimetableModel::where('class_id', $data['class_id'])
                ->where('week_id', $time['week_id'])
                ->where('subject_id', $time['subject_id'])
                ->first();
             if ($existingEntryProblem) {
                    return response()->json(['error' => "L'enseignant n'est pas disponible"], 400);
                }    
            if( $existingEntryProblem_2){
                $existingEntryProblem_2->class_id = $data['class_id'];
                $existingEntryProblem_2->subject_id = $time['subject_id'];
                $existingEntryProblem_2->teacher_id = $TeacherId;
                $existingEntryProblem_2->week_id = $time['week_id'];
                $existingEntryProblem_2->start_time = $time['start_time'];
                $existingEntryProblem_2->end_time = $time['end_time'];
                $existingEntryProblem_2->session_type = '';
                $existingEntryProblem_2->amphi_name = $time['amphi_name'] ?? '';
                $existingEntryProblem_2->bloc_name = $time['bloc_name'] ?? '';
                $existingEntryProblem_2->room_number = $time['room_number'] ?? '';
                $existingEntryProblem_2->save();
            }
           
        
            ClassSubjectTimetableModel::where('class_id', $data['class_id'])
                ->where('subject_id', $time['subject_id'])
                ->where('week_id', $time['week_id'])
                ->where('start_time', $time['start_time'])
                ->where('end_time', $time['end_time'])
                ->delete();
        
            $save = new ClassSubjectTimetableModel;
            $save->class_id = $data['class_id'];
            $save->subject_id = $time['subject_id'];
            $save->teacher_id = $TeacherId;
            $save->week_id = $time['week_id'];
            $save->start_time = $time['start_time'];
            $save->end_time = $time['end_time'];
            $save->session_type = '';
            $save->amphi_name = $time['amphi_name'] ?? '';
            $save->bloc_name = $time['bloc_name'] ?? '';
            $save->room_number = $time['room_number'] ?? '';
            $save->save();
        }
        
        return response()->json(['success' => "La session a été mise à jour avec succès"]);
    }

    public function deleteSession(Request $request)
    {
        $data = $request->all();
        ClassSubjectTimetableModel::where('class_id', $data['class_id'])
            ->where('subject_id', $data['subject_id'])
            ->where('week_id', $data['week_id'])
            ->where('start_time', $data['start_time'])
            ->where('end_time', $data['end_time'])
            ->delete();

        return response()->json(['success' => "La session a été supprimée avec succès"]);
    }

        //student side
        // version
       
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
    $subjectId_teacher = ClassSubjectTimetableModel::getSubjectIdsByTeacherId(Auth::user()->id);
    $getRecord = SubjectModel::getSubjectByIds($subjectId_teacher);
    
    foreach ($getRecord as $subject_id => $value) {
        $dataS['name'] = $value;

        $getWeek = WeekModel::getRecord();
        $week = array();

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubjectByTeacher($subject_id, Auth::user()->id, $valueW->id);

            if (!empty($ClassSubject)) {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
            }

            $week[] = $dataW;
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }


    $data['getRecord'] = $result;
    $data['header_title'] = "My Timetable";

   
    return view('teacher.my_timetable', $data);
}
public function MyTimetable()
{
    $result = array();
    $getRecord = AssignSubjectTeacherModel::MySubject(Auth::user()->class_id);
     
    
    foreach ($getRecord as $value) {
        $dataS['name'] = $value->subject_name;

        $getWeek = WeekModel::getRecord();
        $week = array();

        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject(
                $value->class_id,
                $value->module_id,
                $valueW->id
            );
            if (!empty($ClassSubject)) {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
            }

            $week[] = $dataW;
        }

        $dataS['week'] = $week;
        $result[] = $dataS;
    }   


    $data['getRecord'] = $result;
    $data['header_title'] = "My Timetable";
    $getClassName = ClassModel::getClassName(Auth::user()->class_id);
    $data['getClassName'] = $getClassName;    
    $notifications = Auth::user()->notifications()->where('read', false)->get();
    $unreadCount = $notifications->count();
    $data['unreadCount'] = $unreadCount;
    $data['notifications'] = $notifications;
    return view('student.my_timetable', $data);
}


    
}




