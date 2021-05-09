<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DiagnoseController;
use App\Http\Controllers\MedicineCompanyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::name('medicineCompany.')->prefix('medComp')->middleware(['auth'])->group(function (){
    Route::get('', [MedicineCompanyController::class, 'index'])->name('index');
    Route::get('/list', [MedicineCompanyController::class, 'list'])->name('list');
    Route::post('', [MedicineCompanyController::class, 'store'])->name('store');
    Route::put('/{company_id}', [MedicineCompanyController::class, 'update'])->name('update');
    Route::delete('/{company_id}', [MedicineCompanyController::class, 'delete'])->name('delete');
    Route::get('/{company_id}', [MedicineCompanyController::class, 'show'])->name('show');
});

Route::name('medicine.')->prefix('medicine')->middleware(['auth'])->group(function (){
    Route::get('', [MedicineController::class, 'index'])->name('index');
    Route::get('/list', [MedicineController::class, 'list'])->name('list');
    Route::post('', [MedicineController::class, 'store'])->name('store');
    Route::put('/{medicine_id}', [MedicineController::class, 'update'])->name('update');
    Route::delete('/{medicine_id}', [MedicineController::class, 'delete'])->name('delete');
    Route::get('/{medicine_id}', [MedicineController::class, 'show'])->name('show');
});

Route::name('branch.')->prefix('branch')->middleware(['auth'])->group(function (){
    Route::get('', [BranchController::class, 'index'])->name('index');
    Route::get('/list', [BranchController::class, 'list'])->name('list');
    Route::post('', [BranchController::class, 'store'])->name('store');
    Route::put('/{branch_id}', [BranchController::class, 'update'])->name('update');
    Route::delete('/{branch_id}', [BranchController::class, 'delete'])->name('delete');
    Route::get('/{branch_id}', [BranchController::class, 'show'])->name('show');
});

Route::name('diagnose.')->prefix('diagnose')->middleware(['auth'])->group(function (){
    Route::get('', [DiagnoseController::class, 'index'])->name('index');
    Route::get('/list', [DiagnoseController::class, 'list'])->name('list');
    Route::post('', [DiagnoseController::class, 'store'])->name('store');
    Route::put('/{diagnose_id}', [DiagnoseController::class, 'update'])->name('update');
    Route::delete('/{diagnose_id}', [DiagnoseController::class, 'delete'])->name('delete');
    Route::get('/{diagnose_id}', [DiagnoseController::class, 'show'])->name('show');
});


