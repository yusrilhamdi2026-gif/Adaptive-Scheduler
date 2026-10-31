<?php
namespace App\Services;
use App\Models\Schedule;
class ConflictDetectionService {
    public function candidateConflicts(int $assignmentId, int $periodId, int $roomId, ?int $ignoreScheduleId=null): array {
        $assignment = \App\Models\TeachingAssignment::with('teacher','schoolClass')->findOrFail($assignmentId);
        $q = Schedule::with('assignment')->where('period_id',$periodId)->when($ignoreScheduleId,fn($x)=>$x->where('id','!=',$ignoreScheduleId));
        $rows=$q->get(); $errors=[];
        foreach($rows as $row){
            if($row->assignment->teacher_id===$assignment->teacher_id) $errors[]='Guru sudah mengajar pada jam tersebut.';
            if($row->assignment->school_class_id===$assignment->school_class_id) $errors[]='Kelas sudah memiliki pelajaran pada jam tersebut.';
            if($row->room_id===$roomId) $errors[]='Ruangan sudah digunakan pada jam tersebut.';
        }
        $period=\App\Models\Period::findOrFail($periodId); $room=\App\Models\Room::findOrFail($roomId);
        if($period->is_break) $errors[]='Jam yang dipilih merupakan jam istirahat.';
        if(!$room->is_available) $errors[]='Ruangan tidak tersedia.';
        if($room->capacity < $assignment->schoolClass->student_count) $errors[]='Kapasitas ruangan tidak mencukupi.';
        if($assignment->subject->room_type && $room->room_type && $assignment->subject->room_type!==$room->room_type) $errors[]='Jenis ruangan tidak sesuai dengan mata pelajaran.';
        return array_values(array_unique($errors));
    }
    public function allConflicts(): array {
        $items=[]; $schedules=Schedule::with('assignment.teacher','assignment.subject','assignment.schoolClass','period','room')->get();
        foreach($schedules as $s){$errors=$this->candidateConflicts($s->teaching_assignment_id,$s->period_id,$s->room_id,$s->id); if($errors)$items[]=['schedule'=>$s,'errors'=>$errors];}
        return $items;
    }
}