<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OptimizationWeight extends Model { protected $fillable=['criterion','weight','description']; protected function casts(): array {return ['weight'=>'float'];} }