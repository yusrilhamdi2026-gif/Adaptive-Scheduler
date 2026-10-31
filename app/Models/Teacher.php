<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Teacher extends Model {
    protected $fillable=['name','nip','email','preferred_periods'];
    protected function casts(): array { return ['preferred_periods'=>'array']; }
    public function assignments(){return $this->hasMany(TeachingAssignment::class);}
    public function user(){return $this->hasOne(User::class);}
}