<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ReschedulingLog extends Model { protected $fillable=['schedule_id','old_period_id','new_period_id','old_room_id','new_room_id','reason','old_score','new_score','changed_by']; }