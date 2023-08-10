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
    return view('Welcome');
});


Route::get ('/employee-documents', [EmployeeDocumentController::class, 'index']);
Route::get('/employee-documents/create', [EmployeeDocumentController::class, 'create'])->name('create_documents');
Route::post('/employee-documents', [EmployeeDocumentController::class, 'websave'])->name('store_documents');
Route::get ('/employee-documents/{id}', [EmployeeDocumentController::class, 'edit'])->name('edit_documents');
Route::put ('/employee-documents/{id}', [EmployeeDocumentController::class, 'webupdate'])->name('update_documents');;
Route::delete ('/employee-documents/{id}', [EmployeeDocumentController::class, 'webdelete'])->name('delete_documents');;
