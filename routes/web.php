<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeDocumentController;
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
    return view('Documents.index');
});


Route::get ('/employee-documents', [EmployeeDocumentController::class, 'index']);
Route::get('/employee-documents', [EmployeeDocumentController::class, 'create'])->name('create_value');
Route::post('/employee-documents', [EmployeeDocumentController::class, 'websave'])->name('save');
Route::get ('/employee-documents/{id}', [EmployeeDocumentController::class, 'edit'])->name('edit');;
Route::put ('/employee-documents/{id}', [EmployeeDocumentController::class, 'webupdate']);
Route::delete ('/employee-documents/{id}', [EmployeeDocumentController::class, 'webdelete']);