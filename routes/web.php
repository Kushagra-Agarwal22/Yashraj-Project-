<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrafficController;

Route::get('/', function () {
    $violations = \App\Models\Violation::latest()->get();
    $logsCount = \App\Models\TrafficLog::sum('vehicle_count') ?? 2314;
    $violations_count = $violations->count() > 0 ? $violations->count() : 42; 
    
    return view('welcome', [
        'violations' => $violations,
        'logs' => $logsCount,
        'violations_count' => $violations_count
    ]);
});

Route::get('/cameras', function () {
    return view('cameras');
});

Route::get('/violations', function () {
    $violations = \App\Models\Violation::latest()->get();
    return view('violations', ['violations' => $violations]);
});

Route::get('/rides', function () {
    return view('rides');
});

Route::post('/upload', [TrafficController::class, 'uploadVideo'])->name('uploadVideo');
Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

// Smart Commute iOS Backend Routes (Translated to Laravel)
use App\Http\Controllers\RideController;
Route::post('/api/login', [RideController::class, 'login']);
Route::get('/api/rides', [RideController::class, 'getRides']);
