<?php
namespace App\Http\Controllers;
use App\Models\{Teacher,Subject,SchoolClass,Room,Schedule,TeachingAssignment}; use App\Services\ConflictDetectionService;
class DashboardController extends Controller {
 public function index(ConflictDetectionService $conflicts){return view('dashboard',['teachers'=>Teacher::count(),'subjects'=>Subject::count(),'classes'=>SchoolClass::count(),'rooms'=>Room::count(),'schedules'=>Schedule::count(),'conflictCount'=>count($conflicts->allConflicts()),'assignments'=>TeachingAssignment::count()]);}
}