<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeesController;
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

<<<<<<< HEAD
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
=======
Route::get('/qualifications', [QualificationsController::class, 'index']);
Route::get('/qualifications/{id}', [QualificationsController::class, 'edit']);
Route::post('/qualifications', [QualificationsController::class, 'store']);
Route::put('/qualifications/{id}', [QualificationsController::class, 'update']);
Route::delete('/qualifications/{id}', [QualificationsController::class, 'destory']);

Route::get('/departments', [DepartmentsController::class, 'index']);
Route::get('/departments/{id}', [DepartmentsController::class, 'edit']);
Route::POST('/departments', [DepartmentsController::class, 'store']);
Route::put('/departments/{id}', [DepartmentsController::class, 'update']);
Route::delete('/departments/{id}', [DepartmentsController::class, 'destroy']);

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'edit']);
Route::POST('/companies', [CompanyController::class, 'store']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);
>>>>>>> 1bc7676454b79f984f6bc3213ece05646ef1aba1

Route::get('/employees', [EmployeesController::class, 'index']);
Route::get('/employees/{id}', [EmployeesController::class, 'edit']);
Route::POST('/employees', [EmployeesController::class, 'store']);
Route::put('/employees/{id}', [EmployeesController::class, 'update']);
Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);

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

<<<<<<< HEAD
Route::get ('/allowed-leaves', [AllowedLeaveController::class, 'getAll']);
Route::get ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'getOne']);
Route::POST('/allowed-leaves', [AllowedLeaveController::class, 'save']);
Route::put ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'update']);
Route::delete ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'delete']);
=======
Route::get('/allowedleaves', [AllowedLeaveController::class, 'index']);
Route::get('/allowedleaves/{id}', [AllowedLeaveController::class, 'edit']);
Route::POST('/allowedleaves', [AllowedLeaveController::class, 'store']);
Route::put('/allowedleaves/{id}', [AllowedLeaveController::class, 'update']);
Route::delete('/allowedleaves/{id}', [AllowedLeaveController::class, 'destroy']);
>>>>>>> 1bc7676454b79f984f6bc3213ece05646ef1aba1

Route::get('/leave_requests', [LeaveRequestController::class, 'index']);
Route::get('/leave_requests/{id}', [LeaveRequestController::class, 'edit']);
Route::POST('/leave_requests', [LeaveRequestController::class, 'store']);
Route::put('/leave_requests/{id}', [LeaveRequestController::class, 'update']);
Route::delete('/leave_requests/{id}', [LeaveRequestController::class, 'destroy']);

Route::get('/leavetypes', [LeaveTypeController::class, 'getAll']);
Route::get('/leavetypes/{id}', [LeaveTypeController::class, 'getOne']);
Route::POST('/leavetypes', [LeaveTypeController::class, 'save']);
Route::put('/leavetypes/{id}', [LeaveTypeController::class, 'update']);
Route::delete('/leavetypes/{id}', [LeaveTypeController::class, 'delete']);

Route::get('/shortLeaves', [ShortLeavesController::class, 'index']);
Route::get('/shortLeaves/{id}', [ShortLeavesController::class, 'edit']);
Route::POST('/shortLeaves', [ShortLeavesController::class, 'store']);
Route::put('/shortLeaves/{id}', [ShortLeavesController::class, 'update']);
Route::delete('/shortLeaves/{id}', [ShortLeavesController::class, 'destroy']);

Route::get('/EmployeeQualifications', [EmployeeQualificationsController::class, 'getAll']);
Route::get('/EmployeeQualifications/{id}', [EmployeeQualificationsController::class, 'getOne']);

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::get('/attendance/{id}', [AttendanceController::class, 'edit']);
Route::post('/attendance', [AttendanceController::class, 'store']);
Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'destory']);

Route::get('/recruitmentcandidates', [RecruitmentCandidateController::class, 'index']);
Route::get('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'edit']);
Route::POST('/recruitmentcandidates', [RecruitmentCandidateController::class, 'store']);
Route::put('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'update']);
Route::delete('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'destory']);

Route::get('/resignations', [ResignationsController::class, 'index']);
Route::get('/resignations/{id}', [ResignationsController::class, 'edit']);
Route::POST('/resignations', [ResignationsController::class, 'store']);
Route::put('/resignations/{id}', [ResignationsController::class, 'update']);
Route::delete('/resignations/{id}', [ResignationsController::class, 'destory']);

<<<<<<< HEAD
Route::get ('/instructor', [InstructorController::class, 'getAll']);
Route::get ('/instructor/{id}', [InstructorController::class, 'getOne']);
Route::POST('/instructor', [InstructorController::class, 'save']);
Route::put ('/instructor/{id}', [InstructorController::class, 'update']);
Route::delete ('/instructor/{id}', [InstructorController::class, 'delete']);
=======
Route::get('/instructors', [InstructorController::class, 'index']);
Route::get('/instructors/{id}', [InstructorController::class, 'edit']);
Route::POST('/instructors', [InstructorController::class, 'store']);
Route::put('/instructors/{id}', [InstructorController::class, 'update']);
Route::delete('/instructors/{id}', [InstructorController::class, 'destory']);
>>>>>>> 1bc7676454b79f984f6bc3213ece05646ef1aba1

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
//sangi
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



Route::get('/EmployeeBenefit', [EmployeeBenefitController::class, 'index']);
Route::get('/EmployeeBenefit/{id}', [EmployeeBenefitController::class, 'edit']);
Route::post('/EmployeeBenefit', [EmployeeBenefitController::class, 'store']);
Route::put('/EmployeeBenefit/{id}', [EmployeeBenefitController::class, 'update']);
Route::delete('/EmployeeBenefit/{id}', [EmployeeBenefitController::class, 'destory']);

Route::get('/EmployeeFeedback', [EmployeeFeedbackController::class, 'index']);
Route::get('/EmployeeFeedback/{id}', [EmployeeFeedbackController::class, 'edit']);
Route::post('/EmployeeFeedback', [EmployeeFeedbackController::class, 'store']);
Route::put('/EmployeeFeedback/{id}', [EmployeeFeedbackController::class, 'update']);
Route::delete('/EmployeeFeedback/{id}', [EmployeeFeedbackController::class, 'destory']);

Route::get('/EmployeeHealth', [EmployeeHealthController::class, 'index']);
Route::get('/EmployeeHealth/{id}', [EmployeeHealthController::class, 'edit']);
Route::post('/EmployeeHealth', [EmployeeHealthController::class, 'store']);
Route::put('/EmployeeHealth/{id}', [EmployeeHealthController::class, 'update']);
Route::delete('/EmployeeHealth/{id}', [EmployeeHealthController::class, 'destory']);

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
