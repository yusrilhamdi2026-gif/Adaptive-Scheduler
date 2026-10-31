<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Period extends Model { protected $fillable=['day','period_number','start_time','end_time','is_break']; protected function casts(): array {return ['is_break'=>'boolean'];} }