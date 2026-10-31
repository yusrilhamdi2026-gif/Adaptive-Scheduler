<?php
namespace App\Http\Controllers;
use App\Services\ConflictDetectionService;
class ConflictController extends Controller { public function index(ConflictDetectionService $service){return view('conflicts.index',['items'=>$service->allConflicts()]);} }