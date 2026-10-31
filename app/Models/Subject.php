<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Subject extends Model { protected $fillable=['name','weekly_hours','room_type']; public function assignments(){return $this->hasMany(TeachingAssignment::class);} }