<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Schedule extends Model {
 protected $fillable=['teaching_assignment_id','room_id','period_id','session_number','locked','optimization_score'];
 protected function casts(): array {return ['locked'=>'boolean','optimization_score'=>'float'];}
 public function assignment(){return $this->belongsTo(TeachingAssignment::class,'teaching_assignment_id');} public function room(){return $this->belongsTo(Room::class);} public function period(){return $this->belongsTo(Period::class);}
}