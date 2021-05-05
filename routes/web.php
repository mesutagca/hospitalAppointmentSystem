<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedicineCompanyController;
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
    Route::get('/store', function (){return view('MedCamp');})->name('storeform');
    Route::post('', [MedicineCompanyController::class, 'store'])->name('store');
    Route::put('/{company_id}', [MedicineCompanyController::class, 'update'])->name('update');
    Route::delete('/{company_id}', [MedicineCompanyController::class, 'delete'])->name('delete');
    Route::get('/{company_id}', [MedicineCompanyController::class, 'show'])->name('show');
});


