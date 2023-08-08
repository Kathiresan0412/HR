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

Route::get('/qualification',[QualificationController::class, 'getAll']);
Route::get('/qualification/{id}',[QualificationController::class, 'getOne']);
Route::post('/qualification',[QualificationController::class, 'save']);
Route::put('/qualification/{id}',[QualificationController::class, 'update']);
Route::delete('/qualification/{id}',[QualificationController::class, 'delete']);

Route::get ('/department', [DepartmentController::class, 'getAll']);
Route::get ('/department/{id}', [DepartmentController::class, 'getOne']);
Route::POST('/department', [DepartmentController::class, 'save']);
Route::put ('/department/{id}', [DepartmentController::class, 'update']);
Route::delete ('/department/{id}', [DepartmentController::class, 'delete']);

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

Route::get('/salaryadvance', [SalarayAdvanceController::class, 'getAll']);
Route::get('/salaryadvance/{id}', [SalarayAdvanceController::class, 'getOne']);
Route::post('/salaryadvance', [SalarayAdvanceController::class, 'save']);
Route::put('/salaryadvance/{id}', [SalarayAdvanceController::class, 'update']);
Route::delete('/salaryadvance/{id}', [SalarayAdvanceController::class, 'delete']);

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

Route::get('/leavetypes', [LeaveTypeController::class, 'getAll']);
Route::get('/leavetypes/{id}', [LeaveTypeController::class, 'getOne']);
Route::POST('/leavetypes', [LeaveTypeController::class, 'save']);
Route::put('/leavetypes/{id}', [LeaveTypeController::class, 'update']);
Route::delete('/leavetypes/{id}', [LeaveTypeController::class, 'delete']);



Route::get('/EmployeeQualifications', [EmployeeQualificationsController::class, 'getAll']);
Route::get('/EmployeeQualifications/{id}', [EmployeeQualificationsController::class, 'getOne']);

//Checked by Achsuthan //Cross Checked by Viswa
Route::get('/attendances', [AttendanceController::class, 'getAll']);
Route::get('/attendances/{id}', [AttendanceController::class, 'getOne']);
Route::post('/attendances', [AttendanceController::class, 'save']);
Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendances/{id}', [AttendanceController::class, 'delete']);

Route::get('/recruitmentcandidates', [RecruitmentCandidateController::class, 'index']);
Route::get('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'edit']);
Route::POST('/recruitmentcandidates', [RecruitmentCandidateController::class, 'store']);
Route::put('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'update']);
Route::delete('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'destory']);
//////////////////////
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

///
////
//
Route::get('/instructors', [InstructorController::class, 'index']);
Route::get('/instructors/{id}', [InstructorController::class, 'edit']);
Route::POST('/instructors', [InstructorController::class, 'store']);
Route::put('/instructors/{id}', [InstructorController::class, 'update']);
Route::delete('/instructors/{id}', [InstructorController::class, 'destory']);

Route::get('/employee_documents', [EmployeeDocumentController::class, 'index']);
Route::get('/employee_documents/{id}', [EmployeeDocumentController::class, 'edit']);
Route::POST('/employee_documents', [EmployeeDocumentController::class, 'store']);
Route::put('/employee_documents/{id}', [EmployeeDocumentController::class, 'update']);
Route::delete('/employee_documents/{id}', [EmployeeDocumentController::class, 'destory']);
//aparnan

//achuthan
Route::get('/training_programs', [TrainingProgramController::class, 'index']);
Route::get('/training_programs/{id}', [TrainingProgramController::class, 'edit']);
Route::POST('/training_programs', [TrainingProgramController::class, 'store']);
Route::put('/training_programs/{id}', [TrainingProgramController::class, 'update']);
Route::delete('/training_programs/{id}', [TrainingProgramController::class, 'destory']);





Route::get('/training_records', [TrainingRecordController::class, 'index']);
Route::get('/training_records/{id}', [TrainingRecordController::class, 'edit']);
Route::POST('/training_records', [TrainingRecordController::class, 'store']);
Route::put('/training_records/{id}', [TrainingRecordController::class, 'update']);
Route::delete('/training_records/{id}', [TrainingRecordController::class, 'destory']);

Route::get('/resignations', [ResignationsController::class, 'index']);
Route::get('/resignations/{id}', [ResignationsController::class, 'edit']);
Route::POST('/resignations', [ResignationsController::class, 'store']);
Route::put('/resignations/{id}', [ResignationsController::class, 'update']);
Route::delete('/resignations/{id}', [ResignationsController::class, 'destory']);

Route::get ('/instructor', [InstructorController::class, 'getAll']);
Route::get ('/instructor/{id}', [InstructorController::class, 'getOne']);
Route::POST('/instructor', [InstructorController::class, 'save']);
Route::put ('/instructor/{id}', [InstructorController::class, 'update']);
Route::delete ('/instructor/{id}', [InstructorController::class, 'delete']);

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

Route::get('/work-shifts', [EmployeeWorkShiftController::class, 'index']);
Route::get('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'edit']);
Route::POST('/work-shifts', [EmployeeWorkShiftController::class, 'store']);
Route::put('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'update']);
Route::delete('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'destory']);

Route::get('/promotions', [PromotionsController::class, 'getAll']);
Route::get('/promotions/{id}', [PromotionsController::class, 'getOne']);
Route::post('/promotions', [PromotionsController::class, 'save']);
Route::put('/promotions/{id}', [PromotionsController::class, 'update']);
Route::delete('/promotions/{id}', [PromotionsController::class, 'delete']);


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


Route::get('/EmployeeBenefitType', [EmployeeBenefitTypeController::class, 'index']);
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

Route::get('/EmployeeDisciplinary', [EmployeeDisciplinaryController::class, 'index']);
Route::get('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'edit']);
Route::post('/EmployeeDisciplinary', [EmployeeDisciplinaryController::class, 'store']);
Route::put('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'update']);
Route::delete('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'destory']);

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