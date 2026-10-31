<?php
namespace App\Http\Controllers;
use App\Models\{Schedule,TeachingAssignment,Period,Room}; use App\Services\{AdaptiveSchedulerService,DynamicReschedulingService}; use Illuminate\Http\Request;
class ScheduleController extends Controller {
 public function index(){return view('schedules.index',['schedules'=>Schedule::with('assignment.teacher','assignment.subject','assignment.schoolClass','period','room')->orderBy('period_id')->get()]);}
 public function generate(AdaptiveSchedulerService $service){$result=$service->generate();$msg='Berhasil membuat '.$result['created'].' sesi jadwal.';if($result['failed'])$msg.=' Belum terjadwal: '.implode(', ',$result['failed']);return redirect()->route('schedules.index')->with('status',$msg);}
 public function lock(Schedule $schedule){$schedule->update(['locked'=>!$schedule->locked]);return back()->with('status','Status kunci jadwal diperbarui.');}
 public function reschedule(Request $request,Schedule $schedule,DynamicReschedulingService $service){$data=$request->validate(['reason'=>'required|string|max:500']);$result=$service->reschedule($schedule,$data['reason'],$request->user()->id);return back()->with($result['success']?'status':'error',$result['message']);}
 public function calendar(){return view('schedules.calendar');}
 public function events(){return response()->json(Schedule::with('assignment.teacher','assignment.subject','assignment.schoolClass','period','room')->get()->map(function($s){$day=['Senin'=>1,'Selasa'=>2,'Rabu'=>3,'Kamis'=>4,'Jumat'=>5,'Sabtu'=>6][$s->period->day]??1;$monday=now()->startOfWeek();$date=$monday->copy()->addDays($day-1)->format('Y-m-d');return ['title'=>$s->assignment->subject->name.' - '.$s->assignment->schoolClass->name,'start'=>$date.'T'.$s->period->start_time,'end'=>$date.'T'.$s->period->end_time,'extendedProps'=>['guru'=>$s->assignment->teacher->name,'ruang'=>$s->room->name,'locked'=>$s->locked]];}));}
}