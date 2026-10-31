<?php
namespace App\Services;
use App\Models\{Schedule,TeachingAssignment,Period,Room,OptimizationWeight};
use Illuminate\Support\Facades\DB;
class AdaptiveSchedulerService {
    public function __construct(private ConflictDetectionService $conflicts) {}
    public function generate(): array {
        return DB::transaction(function(){
            Schedule::where('locked',false)->delete();
            $assignments=TeachingAssignment::with(['teacher','subject','schoolClass'])->get()->sortByDesc(fn($a)=>($a->subject->room_type?10:0)+$a->weekly_hours);
            $periods=Period::where('is_break',false)->orderBy('period_number')->get(); $rooms=Room::where('is_available',true)->get();
            $created=0; $failed=[];
            foreach($assignments as $a){
                $lockedSessions=Schedule::where('teaching_assignment_id',$a->id)->where('locked',true)->pluck('session_number')->all();
                for($n=1;$n<=$a->weekly_hours;$n++){
                    if(in_array($n,$lockedSessions)) continue;
                    $best=null; $bestScore=-1;
                    foreach($periods as $p) foreach($rooms as $r){
                        if($this->conflicts->candidateConflicts($a->id,$p->id,$r->id)) continue;
                        $score=$this->score($a,$p,$r);
                        if($score>$bestScore){$bestScore=$score;$best=['period'=>$p,'room'=>$r];}
                    }
                    if(!$best){$failed[]=$a->schoolClass->name.' - '.$a->subject->name.' (sesi '.$n.')';continue;}
                    Schedule::create(['teaching_assignment_id'=>$a->id,'period_id'=>$best['period']->id,'room_id'=>$best['room']->id,'session_number'=>$n,'optimization_score'=>$bestScore]); $created++;
                }
            }
            return ['created'=>$created,'failed'=>$failed];
        });
    }
    public function score(TeachingAssignment $a, Period $p, Room $r): float {
        $weights=OptimizationWeight::pluck('weight','criterion');
        $preference=empty($a->teacher->preferred_periods)||in_array($p->id,$a->teacher->preferred_periods)?100:45;
        $sameDay=Schedule::where('period_id',$p->id)->whereHas('assignment',fn($q)=>$q->where('school_class_id',$a->school_class_id))->count();
        $distribution=max(0,100-20*$sameDay);
        $suitability=$p->period_number<=3?100:70;
        $capacity=max(0,100-(($r->capacity-$a->schoolClass->student_count)/max(1,$r->capacity))*100);
        $stability=50;
        $vals=['teacher_preference'=>$preference,'distribution'=>$distribution,'period_suitability'=>$suitability,'room_utilization'=>$capacity,'stability'=>$stability];
        $totalWeight=max(1,$weights->sum()); $score=0;
        foreach($vals as $key=>$val)$score += $val*(($weights[$key]??20)/$totalWeight);
        return round($score,2);
    }
}