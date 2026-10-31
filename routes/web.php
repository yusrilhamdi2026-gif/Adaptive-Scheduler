<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,DashboardController,ScheduleController,OptimizationWeightController,ConflictController};
Route::get('/',fn()=>redirect(auth()->check()?'/dashboard':'/login'));
Route::middleware('guest')->group(function(){Route::get('/login',[AuthController::class,'showLogin'])->name('login');Route::post('/login',[AuthController::class,'login'])->name('login.submit');});
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function(){
 Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
 Route::get('/jadwal',[ScheduleController::class,'index'])->name('schedules.index');Route::get('/kalender',[ScheduleController::class,'calendar'])->name('schedules.calendar');Route::get('/kalender/events',[ScheduleController::class,'events'])->name('schedules.events');
 Route::middleware('role:admin')->group(function(){Route::post('/jadwal/generate',[ScheduleController::class,'generate'])->name('schedules.generate');Route::patch('/jadwal/{schedule}/lock',[ScheduleController::class,'lock'])->name('schedules.lock');Route::post('/jadwal/{schedule}/reschedule',[ScheduleController::class,'reschedule'])->name('schedules.reschedule');Route::get('/konflik',[ConflictController::class,'index'])->name('conflicts.index');Route::get('/bobot-optimasi',[OptimizationWeightController::class,'index'])->name('weights.index');Route::put('/bobot-optimasi',[OptimizationWeightController::class,'update'])->name('weights.update');});
});