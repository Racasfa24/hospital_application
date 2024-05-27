<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalCertificateController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('doctors', DoctorController::class);
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('medicines', MedicineController::class);
    Route::apiResource('medical-records', MedicalRecordController::class);
    Route::apiResource('prescriptions', PrescriptionController::class);
    Route::apiResource('medical-certificates', MedicalCertificateController::class);
    Route::get('medical-certificates/{medical_certificate}/generate-pdf', [MedicalCertificateController::class, 'generatePdf']);
});

