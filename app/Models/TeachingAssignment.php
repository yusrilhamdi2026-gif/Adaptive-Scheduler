<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeachingAssignment extends Model {
 protected $fillable=['teacher_id','subject_id','school_class_id','weekly_hours'];
 public function teacher(){return $this->belongsTo(Teacher::class);} public function subject(){return $this->belongsTo(Subject::class);} public function schoolClass(){return $this->belongsTo(SchoolClass::class,'school_class_id');} public function schedules(){return $this->hasMany(Schedule::class);}
}