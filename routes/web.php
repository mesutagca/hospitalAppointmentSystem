<?php

use App\Helper\Methods\HelperMethods;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DiagnoseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineCompanyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientDocumentController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
        return view('dashboard');
})->middleware(['lang','auth'])->name('dashboard.index');

require __DIR__.'/auth.php';

Route::get('/changelang/{selected}', function (Request $request,$selected){
    session(['setLocale' => $selected]);
    return redirect()->back();
});


Route::name('medicineCompanies.')->prefix('medicineCompanies')->middleware(['auth'])->group(function (){
    Route::get('', [MedicineCompanyController::class, 'index'])->name('index');
    Route::get('/list', [MedicineCompanyController::class, 'list'])->name('list');
    Route::post('', [MedicineCompanyController::class, 'store'])->name('store');
    Route::put('/{company_id}', [MedicineCompanyController::class, 'update'])->name('update');
    Route::delete('/{company_id}', [MedicineCompanyController::class, 'delete'])->name('delete');
    Route::get('/{company_id}', [MedicineCompanyController::class, 'show'])->name('show');
});

Route::name('medicines.')->prefix('medicines')->middleware(['auth'])->group(function (){
    Route::get('', [MedicineController::class, 'index'])->name('index');
    Route::get('/list', [MedicineController::class, 'list'])->name('list');
    Route::post('', [MedicineController::class, 'store'])->name('store');
    Route::put('/{medicine_id}', [MedicineController::class, 'update'])->name('update');
    Route::delete('/{medicine_id}', [MedicineController::class, 'delete'])->name('delete');
    Route::get('/{medicine_id}', [MedicineController::class, 'show'])->name('show');
});

Route::name('branches.')->prefix('branches')->middleware(['auth'])->group(function (){
    Route::get('', [BranchController::class, 'index'])->name('index');
    Route::get('/list', [BranchController::class, 'list'])->name('list');
    Route::post('', [BranchController::class, 'store'])->name('store');
    Route::put('/{branch_id}', [BranchController::class, 'update'])->name('update');
    Route::delete('/{branch_id}', [BranchController::class, 'delete'])->name('delete');
    Route::get('/{branch_id}', [BranchController::class, 'show'])->name('show');
});

Route::name('diagnoses.')->prefix('diagnoses')->middleware(['auth'])->group(function (){
    Route::get('', [DiagnoseController::class, 'index'])->name('index');
    Route::get('/list', [DiagnoseController::class, 'list'])->name('list');
    Route::post('', [DiagnoseController::class, 'store'])->name('store');
    Route::put('/{diagnose_id}', [DiagnoseController::class, 'update'])->name('update');
    Route::delete('/{diagnose_id}', [DiagnoseController::class, 'delete'])->name('delete');
    Route::get('/{diagnose_id}', [DiagnoseController::class, 'show'])->name('show');
});

Route::name('appointments.')->prefix('appointments')->middleware(['auth'])->group(function (){
    Route::get('', [AppointmentController::class, 'index'])->name('index');
    Route::get('/list', [AppointmentController::class, 'list'])->name('list');
    Route::post('', [AppointmentController::class, 'store'])->name('store');
    Route::put('/{appointment_id}', [AppointmentController::class, 'update'])->name('update');
    Route::delete('/{appointment_id}', [AppointmentController::class, 'delete'])->name('delete');
    Route::get('/{appointment_id}', [AppointmentController::class, 'show'])->name('show');

});

Route::name('doctors.')->prefix('doctors')->middleware(['auth'])->group(function (){
    Route::get('', [DoctorController::class, 'index'])->name('index');
    Route::get('/list', [DoctorController::class, 'list'])->name('list');
    Route::post('', [DoctorController::class, 'store'])->name('store');
    Route::put('/{doctor_id}', [DoctorController::class, 'update'])->name('update');
    Route::delete('/{doctor_id}', [DoctorController::class, 'delete'])->name('delete');
    Route::get('/{doctor_id}', [DoctorController::class, 'show'])->name('show');
});

Route::name('patientDocuments.')->prefix('patientDocuments')->middleware(['auth'])->group(function (){
    Route::get('/{appointment_id}/{patient_document_path}', [PatientDocumentController::class, 'download'])->name('download');
    Route::delete('/{appointment_id}/{patient_document_path}', [PatientDocumentController::class, 'delete'])->name('delete');

});

Route::name('treatments.')->prefix('treatments')->middleware(['auth'])->group(function (){
    Route::post('/{appointment_id}', [TreatmentController::class, 'treatPatient'])->name('treatPatient');
    Route::get('/{treatment_id}/recipes/{recipe_id}', [TreatmentController::class, 'downloadRecipeMedicines'])->name('downloadRecipeMedicines');
    Route::delete('/recipeMedicines/{treatment_id}/{recipe_id}', [TreatmentController::class, 'deleteRecipeMedicines'])->name('deleteRecipeMedicines');
});




