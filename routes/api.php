<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\DepartmentController;
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

Route::get('/positions', [PositionController::class, 'getAll']);
Route::get('/positions/{id}', [PositionController::class, 'getOne']);
Route::post('/positions', [PositionController::class, 'save']);
Route::put('/positions/{id}', [PositionController::class, 'update']);
Route::delete('/positions/{id}', [PositionController::class, 'delete']);

Route::get('/salary-types',[SalaryTypeController::class, 'getAll']);
Route::get('/salary-types/{id}',[SalaryTypeController::class, 'getOne']);
Route::post('/salary-types',[SalaryTypeController::class, 'save']);
Route::put('/salary-types/{id}',[SalaryTypeController::class, 'update']);
Route::delete('/salary-types/{id}',[SalaryTypeController::class, 'delete']);

Route::get('/qualifications',[QualificationController::class, 'getAll']);
Route::get('/qualifications/{id}',[QualificationController::class, 'getOne']);
Route::post('/qualifications',[QualificationController::class, 'save']);
Route::put('/qualifications/{id}',[QualificationController::class, 'update']);
Route::delete('/qualifications/{id}',[QualificationController::class, 'delete']);

Route::get ('/departments', [DepartmentController::class, 'getAll']);
Route::get ('/departments/{id}', [DepartmentController::class, 'getOne']);
Route::POST('/departments', [DepartmentController::class, 'save']);
Route::put ('/departments/{id}', [DepartmentController::class, 'update']);
Route::delete ('/departments/{id}', [DepartmentController::class, 'delete']);

Route::get ('/companies', [CompanyController::class, 'getAll']);
Route::get ('/companies/{id}', [CompanyController::class, 'getOne']);
Route::POST('/companies', [CompanyController::class, 'save']);
Route::put ('/companies/{id}', [CompanyController::class, 'update']);
Route::delete ('/companies/{id}', [CompanyController::class, 'delete']);

Route::get ('/employees', [EmployeeController::class, 'getAll']);
Route::get ('/employees/{id}', [EmployeeController::class, 'getOne']);
Route::POST('/employees', [EmployeeController::class, 'save']);
Route::put ('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete ('/employees/{id}', [EmployeeController::class, 'delete']);

Route::get('/announcements', [AnnouncementController::class, 'getAll']);
Route::get('/announcements/{id}', [AnnouncementController::class, 'getOne']);
Route::POST('/announcements', [AnnouncementController::class, 'save']);
Route::put('/announcements/{id}', [AnnouncementController::class, 'update']);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'delete']);

Route::get('/salary-advances', [SalarayAdvanceController::class, 'getAll']);
Route::get('/salary-advances/{id}', [SalarayAdvanceController::class, 'getOne']);
Route::post('/salary-advances', [SalarayAdvanceController::class, 'save']);
Route::put('/salary-advances/{id}', [SalarayAdvanceController::class, 'update']);
Route::delete('/salary-advances/{id}', [SalarayAdvanceController::class, 'delete']);

Route::get ('/allowed-leaves', [AllowedLeaveController::class, 'getAll']);
Route::get ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'getOne']);
Route::POST('/allowed-leaves', [AllowedLeaveController::class, 'save']);
Route::put ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'update']);
Route::delete ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'delete']);

//Checked by Achsuthan //Cross Checked by Viswa
Route::get ('/leave-requests', [LeaveRequestController::class, 'getAll']);
Route::get ('/leave-requests/{id}', [LeaveRequestController::class, 'getOne']);
Route::POST('/leave-requests', [LeaveRequestController::class, 'save']);
Route::put ('/leave-requests/{id}', [LeaveRequestController::class, 'update']);
Route::delete ('/leave-requests/{id}', [LeaveRequestController::class, 'delete']);

Route::get('/leave-types', [LeaveTypeController::class, 'getAll']);
Route::get('/leave-types/{id}', [LeaveTypeController::class, 'getOne']);
Route::POST('/leave-types', [LeaveTypeController::class, 'save']);
Route::put('/leave-types/{id}', [LeaveTypeController::class, 'update']);
Route::delete('/leave-types/{id}', [LeaveTypeController::class, 'delete']);

Route::get('/Employee-qualifications', [EmployeeQualificationsController::class, 'getAll']);
Route::get('/Employee-qualifications/{id}', [EmployeeQualificationsController::class, 'getOne']);

//Checked by Achsuthan //Cross Checked by Viswa
Route::get('/attendances', [AttendanceController::class, 'getAll']);
Route::get('/attendances/{id}', [AttendanceController::class, 'getOne']);
Route::post('/attendances', [AttendanceController::class, 'save']);
Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendances/{id}', [AttendanceController::class, 'delete']);

Route::get ('/recruitment-candidates', [RecruitmentCandidateController::class, 'getAll']);
Route::get ('/recruitment-candidates/{id}', [RecruitmentCandidateController::class, 'getOne']);
Route::POST('/recruitment-candidates', [RecruitmentCandidateController::class, 'save']);
Route::put ('/recruitment-candidates/{id}', [RecruitmentCandidateController::class, 'update']);
Route::delete ('/recruitment-candidates/{id}', [RecruitmentCandidateController::class, 'delete']);

Route::get('/resignations', [ResignationsController::class, 'getAll']);
Route::get('/resignations/{id}', [ResignationsController::class, 'getOne']);
Route::POST('/resignations', [ResignationsController::class, 'save']);
Route::put('/resignations/{id}', [ResignationsController::class, 'update']);
Route::delete('/resignations/{id}', [ResignationsController::class, 'delete']);

Route::get('/work-shifts', [EmployeeWorkShiftController::class, 'getAll']);
Route::get('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'getOne']);
Route::POST('/work-shifts', [EmployeeWorkShiftController::class, 'save']);
Route::put('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'update']);
Route::delete('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'delete']);

Route::get('/short-leaves', [ShortLeavesController::class, 'getAll']);
Route::get('/short-leaves/{id}', [ShortLeavesController::class, 'getOne']);
Route::POST('/short-leaves', [ShortLeavesController::class, 'save']);
Route::put('/short-leaves/{id}', [ShortLeavesController::class, 'update']);
Route::delete('/short-leaves/{id}', [ShortLeavesController::class, 'delete']);

Route::get('/promotions', [PromotionsController::class, 'getAll']);
Route::get('/promotions/{id}', [PromotionsController::class, 'getOne']);
Route::post('/promotions', [PromotionsController::class, 'save']);
Route::put('/promotions/{id}', [PromotionsController::class, 'update']);
Route::delete('/promotions/{id}', [PromotionsController::class, 'delete']);

Route::get('/employee-benefit-types', [EmployeeBenefitTypeController::class, 'getAll']);
Route::get('/employee-benefit-types/{id}', [EmployeeBenefitTypeController::class, 'getOne']);
Route::post('/employee-benefit-types', [EmployeeBenefitTypeController::class, 'save']);
Route::put('/employee-benefit-types/{id}', [EmployeeBenefitTypeController::class, 'update']);
Route::delete('/employee-benefit-types/{id}', [EmployeeBenefitTypeController::class, 'delete']);

//aparnan

Route::get ('/instructors', [InstructorController::class, 'getAll']);
Route::get ('/instructors/{id}', [InstructorController::class, 'getOne']);
Route::POST('/instructors', [InstructorController::class, 'save']);
Route::put ('/instructors/{id}', [InstructorController::class, 'update']);
Route::delete ('/instructors/{id}', [InstructorController::class, 'delete']);

Route::get ('/employee-documents', [EmployeeDocumentController::class, 'getAll']);
Route::get ('/employee-documents/{id}', [EmployeeDocumentController::class, 'getOne']);
Route::POST('/employee-documents', [EmployeeDocumentController::class, 'save']);
Route::put ('/employee-documents/{id}', [EmployeeDocumentController::class, 'update']);
Route::delete ('/employee-documents/{id}', [EmployeeDocumentController::class, 'delete']);
//aparnan

//achuthan
Route::get ('/training-programs', [TrainingProgramController::class, 'getAll']);
Route::get ('/training-programs/{id}', [TrainingProgramController::class, 'getOne']);
Route::POST('/training-programs', [TrainingProgramController::class, 'save']);
Route::put ('/training-programs/{id}', [TrainingProgramController::class, 'update']);
Route::delete ('/training-programs/{id}', [TrainingProgramController::class, 'delete']);


Route::get ('/training-records', [TrainingRecordController::class, 'getAll']);
Route::get ('/training-records/{id}', [TrainingRecordController::class, 'getOne']);
Route::POST('/training-records', [TrainingRecordController::class, 'save']);
Route::put ('/training-records/{id}', [TrainingRecordController::class, 'update']);
Route::delete ('/training-records/{id}', [TrainingRecordController::class, 'delete']);

Route::get('/ots', [OTSController::class, 'getAll']);
Route::get('/ots/{id}', [OTSController::class, 'getOne']);
Route::post('/ots', [OTSController::class, 'save']);
Route::put('/ots/{id}', [OTSController::class, 'update']);
Route::delete('/ots/{id}', [OTSController::class, 'delete']);


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

//Checked by Achsuthan //Cross Checked by Viswa
Route::get('/employee-emergency-contacts', [EmployeeEmergencyContactController::class, 'getAll']);
Route::get('/employee-emergency-contacts/{id}', [EmployeeEmergencyContactController::class, 'getOne']);
Route::post('/employee-emergency-contacts', [EmployeeEmergencyContactController::class, 'save']);
Route::put('/employee-emergency-contacts/{id}', [EmployeeEmergencyContactController::class, 'update']);
Route::delete('/employee-emergency-contacts/{id}', [EmployeeEmergencyContactController::class, 'delete']);

//Checked by Achsuthan //Cross Checked by Viswa
Route::get('/employee-disciplinaries', [EmployeeDisciplinaryController::class, 'getAll']);
Route::get('/employee-disciplinaries/{id}', [EmployeeDisciplinaryController::class, 'getOne']);
Route::post('/employee-disciplinaries', [EmployeeDisciplinaryController::class, 'save']);
Route::put('/employee-disciplinaries/{id}', [EmployeeDisciplinaryController::class, 'update']);
Route::delete('/employee-disciplinaries/{id}', [EmployeeDisciplinaryController::class, 'delete']);