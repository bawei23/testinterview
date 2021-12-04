<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});





Auth::routes();

Route::get('/create_company', [App\Http\Controllers\CompanyController::class, 'create_company'])->middleware('auth')->name('create_company');
Route::post('/store_company', [App\Http\Controllers\CompanyController::class, 'store_company'])->name('company.store');
Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->middleware('auth')->name('companies');
Route::post('/datacompany', [App\Http\Controllers\CompanyController::class, 'datacompany'])->middleware('auth')->name('datacompany');
Route::post('/delete_company', [App\Http\Controllers\CompanyController::class, 'delete_company'])->middleware('auth')->name('company.delete');
Route::post('/update_company', [App\Http\Controllers\CompanyController::class, 'update_company'])->middleware('auth')->name('company.update');

Route::get('/detail_company/{id}', [App\Http\Controllers\CompanyController::class, 'detail_company'])->name('detail_company');

Route::get('/create_employees', [App\Http\Controllers\EmployeesController::class, 'create_employees'])->middleware('auth')->name('create_employees');
Route::post('/store_employees', [App\Http\Controllers\EmployeesController::class, 'store_employees'])->name('employees.store');
Route::get('/employees', [App\Http\Controllers\EmployeesController::class, 'index'])->middleware('auth')->name('employees');
Route::post('/datauser', [App\Http\Controllers\EmployeesController::class, 'datauser'])->middleware('auth')->name('datauser');
Route::post('/delete_employee', [App\Http\Controllers\EmployeesController::class, 'delete_user'])->middleware('auth')->name('employees.delete');
Route::post('/update_employees', [App\Http\Controllers\EmployeesController::class, 'update_employees'])->middleware('auth')->name('employees.update');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
