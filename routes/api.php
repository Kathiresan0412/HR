<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\QualificationsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\SalarayAdvanceController;
use App\Http\Controllers\AllowedLeaveController;
use App\Http\Controllers\ShortLeavesController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\EmployeeQualificationsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RecruitmentCandidateController;
use App\Http\Controllers\ResignationsController;
use App\Http\Controllers\EmployeeBenefitTypeController;
use App\Http\Controllers\TrainingRecordController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\EmployeeWorkShiftController;
use App\Http\Controllers\EmployeeFeedbackController;
use App\Http\Controllers\EmployeeDocumentController;
use App\Http\Controllers\EmployeeHealthController;
use App\Http\Controllers\EmployeeEmergencyContactController;
use App\Http\Controllers\EmployeeDisciplinaryController;
use App\Http\Controllers\EmployeeBenefitController;
use App\Http\Controllers\OTSController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/positions',[PositionController::class, 'index']);
Route::get('/positions/{id}',[PositionController::class, 'edit']);
Route::post('/positions',[PositionController::class, 'store']);
Route::put('/positions/{id}',[PositionController::class, 'update']);
Route::delete('/positions/{id}',[PositionController::class, 'destory']);

Route::get('/salarytypes',[SalaryTypeController::class, 'index']);
Route::get('/salarytypes/{id}',[SalaryTypeController::class, 'edit']);
Route::post('/salarytypes',[SalaryTypeController::class, 'store']);
Route::put('/salarytypes/{id}',[SalaryTypeController::class, 'update']);
Route::delete('/salarytypes/{id}',[SalaryTypeController::class, 'destory']);

Route::get('/qualifications',[QualificationsController::class, 'index']);
Route::get('/qualifications/{id}',[QualificationsController::class, 'edit']);
Route::post('/qualifications',[QualificationsController::class, 'store']);
Route::put('/qualifications/{id}',[QualificationsController::class, 'update']);
Route::delete('/qualifications/{id}',[QualificationsController::class, 'destory']);

Route::get ('/departments', [DepartmentsController::class, 'index']);
Route::get ('/departments/{id}', [DepartmentsController::class, 'edit']);
Route::POST('/departments', [DepartmentsController::class, 'store']);
Route::put ('/departments/{id}', [DepartmentsController::class, 'update']);
Route::delete ('/departments/{id}', [DepartmentsController::class, 'destroy']);

Route::get ('/companies', [CompanyController::class, 'index']);
Route::get ('/companies/{id}', [CompanyController::class, 'edit']);
Route::POST('/companies', [CompanyController::class, 'store']);
Route::put ('/companies/{id}', [CompanyController::class, 'update']);
Route::delete ('/companies/{id}', [CompanyController::class, 'destroy']);

Route::get ('/employees', [EmployeeController::class, 'getAll']);
Route::get ('/employees/{id}', [EmployeeController::class, 'getOne']);
Route::POST('/employees', [EmployeeController::class, 'save']);
Route::put ('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete ('/employees/{id}', [EmployeeController::class, 'delete']);

Route::get ('/announcements', [AnnouncementController::class, 'index']);
Route::get ('/announcements/{id}', [AnnouncementController::class, 'edit']);
Route::POST('/announcements', [AnnouncementController::class, 'store']);
Route::put ('/announcements/{id}', [AnnouncementController::class, 'update']);
Route::delete ('/announcements/{id}', [AnnouncementController::class, 'destroy']);

Route::get('/salaryadvance', [SalarayAdvanceController::class, 'index']);
Route::get('/salaryadvance/{id}', [SalarayAdvanceController::class, 'edit']);
Route::post('/salaryadvance', [SalarayAdvanceController::class, 'store']);
Route::put('/salaryadvance/{id}', [SalarayAdvanceController::class, 'update']);
Route::delete('/salaryadvance/{id}', [SalarayAdvanceController::class, 'destroy']);

Route::get ('/allowedleaves', [AllowedLeaveController::class, 'index']);
Route::get ('/allowedleaves/{id}', [AllowedLeaveController::class, 'edit']);
Route::POST('/allowedleaves', [AllowedLeaveController::class, 'store']);
Route::put ('/allowedleaves/{id}', [AllowedLeaveController::class, 'update']);
Route::delete ('/allowedleaves/{id}', [AllowedLeaveController::class, 'destroy']);

Route::get ('/leave_requests', [LeaveRequestController::class, 'index']);
Route::get ('/leave_requests/{id}', [LeaveRequestController::class, 'edit']);
Route::POST('/leave_requests', [LeaveRequestController::class, 'store']);
Route::put ('/leave_requests/{id}', [LeaveRequestController::class, 'update']);
Route::delete ('/leave_requests/{id}', [LeaveRequestController::class, 'destroy']);

Route::get ('/leavetypes', [LeaveTypeController::class, 'index']);
Route::get ('/leavetypes/{id}', [LeaveTypeController::class, 'edit']);
Route::POST('/leavetypes', [LeaveTypeController::class, 'store']);
Route::put ('/leavetypes/{id}', [LeaveTypeController::class, 'update']);
Route::delete ('/leavetypes/{id}', [LeaveTypeController::class, 'destroy']);

Route::get ('/shortLeaves', [ShortLeavesController::class, 'index']);
Route::get ('/shortLeaves/{id}', [ShortLeavesController::class, 'edit']);
Route::POST('/shortLeaves', [ShortLeavesController::class, 'store']);
Route::put ('/shortLeaves/{id}', [ShortLeavesController::class, 'update']);
Route::delete ('/shortLeaves/{id}', [ShortLeavesController::class, 'destroy']);

Route::get ('/EmployeeQualifications', [EmployeeQualificationsController::class, 'index']);
Route::get ('/EmployeeQualifications/{id}', [EmployeeQualificationsController::class, 'edit']);

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::get('/attendance/{id}', [AttendanceController::class, 'edit']);
Route::post('/attendance', [AttendanceController::class, 'store']);
Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'destory']);

Route::get ('/recruitmentcandidates', [RecruitmentCandidateController::class, 'index']);
Route::get ('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'edit']);
Route::POST('/recruitmentcandidates', [RecruitmentCandidateController::class, 'store']);
Route::put ('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'update']);
Route::delete ('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'destory']);

Route::get ('/resignations', [ResignationsController::class, 'index']);
Route::get ('/resignations/{id}', [ResignationsController::class, 'edit']);
Route::POST('/resignations', [ResignationsController::class, 'store']);
Route::put ('/resignations/{id}', [ResignationsController::class, 'update']);
Route::delete ('/resignations/{id}', [ResignationsController::class, 'destory']);

Route::get ('/instructors', [InstructorController::class, 'index']);
Route::get ('/instructors/{id}', [InstructorController::class, 'edit']);
Route::POST('/instructors', [InstructorController::class, 'store']);
Route::put ('/instructors/{id}', [InstructorController::class, 'update']);
Route::delete ('/instructors/{id}', [InstructorController::class, 'destory']);

Route::get ('/employee_documents', [EmployeeDocumentController::class, 'index']);
Route::get ('/employee_documents/{id}', [EmployeeDocumentController::class, 'edit']);
Route::POST('/employee_documents', [EmployeeDocumentController::class, 'store']);
Route::put ('/employee_documents/{id}', [EmployeeDocumentController::class, 'update']);
Route::delete ('/employee_documents/{id}', [EmployeeDocumentController::class, 'destory']);
//aparnan

//achuthan
Route::get ('/training_programs', [TrainingProgramController::class, 'index']);
Route::get ('/training_programs/{id}', [TrainingProgramController::class, 'edit']);
Route::POST('/training_programs', [TrainingProgramController::class, 'store']);
Route::put ('/training_programs/{id}', [TrainingProgramController::class, 'update']);
Route::delete ('/training_programs/{id}', [TrainingProgramController::class, 'destory']);

Route::get ('/work-shifts', [EmployeeWorkShiftController::class, 'index']);
Route::get ('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'edit']);
Route::POST('/work-shifts', [EmployeeWorkShiftController::class, 'store']);
Route::put ('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'update']);
Route::delete ('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'destory']);

Route::get('/promotions', [PromotionsController::class, 'index']);
Route::get('/promotions/{id}', [PromotionsController::class, 'edit']);
Route::post('/promotions', [PromotionsController::class, 'store']);
Route::put('/promotions/{id}', [PromotionsController::class, 'update']);
Route::delete('/promotions/{id}', [PromotionsController::class, 'destory']);


Route::get ('/training_records', [TrainingRecordController::class, 'index']);
Route::get ('/training_records/{id}', [TrainingRecordController::class, 'edit']);
Route::POST('/training_records', [TrainingRecordController::class, 'store']);
Route::put ('/training_records/{id}', [TrainingRecordController::class, 'update']);
Route::delete ('/training_records/{id}', [TrainingRecordController::class, 'destory']);
//sangi
Route::get('/ots', [OTSController::class, 'index']);
Route::get('/ots/{id}', [OTSController::class, 'edit']);
Route::post('/ots', [OTSController::class, 'store']);
Route::put('/ots/{id}', [OTSController::class, 'update']);
Route::delete('/ots/{id}', [OTSController::class, 'destory']);

Route::get('/EmployeeBenefitType', [EmployeeBenefitTypeController::class,'index']);
Route::get('/EmployeeBenefitType/{id}', [EmployeeBenefitTypeController::class, 'edit']);
Route::post('/EmployeeBenefitType', [EmployeeBenefitTypeController::class, 'store']);
Route::put('/EmployeeBenefitType/{id}', [EmployeeBenefitTypeController::class, 'update']);
Route::delete('/EmployeeBenefitType/{id}', [EmployeeBenefitTypeController::class, 'destory']);



Route::get('/employee-benefits', [EmployeeBenefitController::class, 'getAll']);
Route::get('/employee-benefits/{id}', [EmployeeBenefitController::class, 'getOne']);
Route::post('/employee-benefits', [EmployeeBenefitController::class, 'save']);
Route::put('/employee-benefits/{id}', [EmployeeBenefitController::class, 'update']);
Route::delete('/employee-benefits/{id}', [EmployeeBenefitController::class, 'delete']);

Route::get('/employee-feedbacks', [EmployeeFeedbackController::class, 'getAll']);
Route::get('/employee-feedbacks/{id}', [EmployeeFeedbackController::class, 'getOne']);
Route::post('/employee-feedbacks', [EmployeeFeedbackController::class, 'save']);
Route::put('/employee-feedbacks/{id}', [EmployeeFeedbackController::class, 'update']);
Route::delete('/employee-feedbacks/{id}', [EmployeeFeedbackController::class, 'delete']);

Route::get('/employee-healths', [EmployeeHealthController::class, 'getAll']);
Route::get('/employee-healths/{id}', [EmployeeHealthController::class, 'getOne']);
Route::post('/employee-healths', [EmployeeHealthController::class, 'save']);
Route::put('/employee-healths/{id}', [EmployeeHealthController::class, 'update']);
Route::delete('/employee-healths/{id}', [EmployeeHealthController::class, 'delete']);

Route::get('/EmployeeEmergency', [EmployeeEmergencyContactController::class, 'index']);
Route::get('/EmployeeEmergency/{id}', [EmployeeEmergencyContactController::class, 'edit']);
Route::post('/EmployeeEmergency', [EmployeeEmergencyContactController::class, 'store']);
Route::put('/EmployeeEmergency/{id}', [EmployeeEmergencyContactController::class, 'update']);
Route::delete('/EmployeeEmergency/{id}', [EmployeeEmergencyContactController::class, 'destory']);
//achuthan
Route::get('/EmployeeDisciplinary', [EmployeeDisciplinaryController::class, 'index']);
Route::get('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'edit']);
Route::post('/EmployeeDisciplinary', [EmployeeDisciplinaryController::class, 'store']);
Route::put('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'update']);
Route::delete('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'destory']);
