<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/patients', PatientController::class);
    Route::resource('/doctors', DoctorController::class);
    Route::resource('/medicalHistory', MedicalHistoryController::class);
    Route::get('/medicalHistory/{patient}/createMedicalHistory', [MedicalHistoryController::class, 'CreateMedicalHistory'])->name('medicalHistory.createMedicalHistory');
    Route::get('/consultations/{medicalHistory}/getConsultations', [ConsultationController::class, 'getConsultations'])->name('consultations.getConsultations');
    Route::resource('/consultations', ConsultationController::class);
    Route::get('/consultations/{medicalHistory}/createConsultation', [ConsultationController::class, 'CreateConsultation'])->name('consultations.createConsultation');
});

/* Route::middleware('auth')->group(function () {
    
    Route::resource('patients', PatientController::class);
}); */

require __DIR__.'/auth.php';
