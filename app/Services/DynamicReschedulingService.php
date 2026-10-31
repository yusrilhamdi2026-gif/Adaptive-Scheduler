<?php
namespace App\Services;
use App\Models\{Schedule,Period,Room,ReschedulingLog};
use Illuminate\Support\Facades\DB;
class DynamicReschedulingService {
 public function __construct(private ConflictDetectionService $conflicts, private AdaptiveSchedulerService $optimizer){}
 public function reschedule(Schedule $schedule,string $reason,?int $userId=null): array {
  if($schedule->locked) return ['success'=>false,'message'=>'Jadwal dikunci dan tidak dapat dipindahkan.'];
  return DB::transaction(function()use($schedule,$reason,$userId){
   $schedule->load('assignment.teacher','assignment.subject','assignment.schoolClass'); $oldPeriod=$schedule->period_id;$oldRoom=$schedule->room_id;$oldScore=$schedule->optimization_score;
   $best=null;$bestScore=-1;
   foreach(Period::where('is_break',false)->get() as $p) foreach(Room::where('is_available',true)->get() as $r){
    if($this->conflicts->candidateConflicts($schedule->teaching_assignment_id,$p->id,$r->id,$schedule->id))continue;
    $score=$this->optimizer->score($schedule->assignment,$p,$r);
    if($score>$bestScore){$bestScore=$score;$best=['period'=>$p,'room'=>$r];}
   }
   if(!$best)return ['success'=>false,'message'=>'Tidak ditemukan slot dan ruangan pengganti yang memenuhi kendala.'];
   $schedule->update(['period_id'=>$best['period']->id,'room_id'=>$best['room']->id,'optimization_score'=>$bestScore]);
   ReschedulingLog::create(['schedule_id'=>$schedule->id,'old_period_id'=>$oldPeriod,'new_period_id'=>$best['period']->id,'old_room_id'=>$oldRoom,'new_room_id'=>$best['room']->id,'reason'=>$reason,'old_score'=>$oldScore,'new_score'=>$bestScore,'changed_by'=>$userId]);
   return ['success'=>true,'message'=>'Jadwal berhasil dipindahkan.'];
  });
 }
}