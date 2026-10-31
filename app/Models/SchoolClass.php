<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SchoolClass extends Model { protected $table='school_classes'; protected $fillable=['name','grade','major','student_count']; public function assignments(){return $this->hasMany(TeachingAssignment::class);} }