<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\QualificationsController;
use App\Http\Controllers\DepartmentsController;
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

Route::get('/positions',[PositionController::class, 'getAllPositions']);
Route::get('/positions/{id}',[PositionController::class, 'getPositionInfo']);
Route::post('/positions',[PositionController::class, 'savePosition']);
Route::put('/positions/{id}',[PositionController::class, 'updatePosition']);
Route::delete('/positions/{id}',[PositionController::class, 'destory']);

Route::get('/salary-types',[SalaryTypeController::class, 'getAll']);
Route::get('/salary-types/{id}',[SalaryTypeController::class, 'getOne']);
Route::post('/salary-types',[SalaryTypeController::class, 'save']);
Route::put('/salary-types/{id}',[SalaryTypeController::class, 'update']);
Route::delete('/salary-types/{id}',[SalaryTypeController::class, 'delete']);

Route::get('/qualifications',[QualificationsController::class, 'index']);
Route::get('/qualifications/{id}',[QualificationsController::class, 'edit']);
Route::post('/qualifications',[QualificationsController::class, 'saveQualification']);
Route::put('/qualifications/{id}',[QualificationsController::class, 'updateQualification']);
Route::delete('/qualifications/{id}',[QualificationsController::class, 'destory']);

Route::get ('/departments', [DepartmentsController::class, 'getAllDepartment']);
Route::get ('/departments/{id}', [DepartmentsController::class, 'getDepartmentInfo']);
Route::POST('/departments', [DepartmentsController::class, 'saveDepartment']);
Route::put ('/departments/{id}', [DepartmentsController::class, 'updateDepartment']);
Route::delete ('/departments/{id}', [DepartmentsController::class, 'destroy']);

Route::get ('/companies', [CompanyController::class, 'getAllCompany']);
Route::get ('/companies/{id}', [CompanyController::class, 'getCompanyInfo']);
Route::POST('/companies', [CompanyController::class, 'saveCompany']);
Route::put ('/companies/{id}', [CompanyController::class, 'updateCompany']);
Route::delete ('/companies/{id}', [CompanyController::class, 'destroy']);

Route::get ('/employees', [EmployeesController::class, 'getAllEmployees']);
Route::get ('/employees/{id}', [EmployeesController::class, 'getEmployeeInfo']);
Route::POST('/employees', [EmployeesController::class, 'saveEmployee']);
Route::put ('/employees/{id}', [EmployeesController::class, 'updateEmployee']);
Route::delete ('/employees/{id}', [EmployeesController::class, 'destroy']);

Route::get ('/announcements', [AnnouncementController::class, 'getAllAnnouncement']);
Route::get ('/announcements/{id}', [AnnouncementController::class, 'getAnnouncementInfo']);
Route::POST('/announcements', [AnnouncementController::class, 'saveAnnouncement']);
Route::put ('/announcements/{id}', [AnnouncementController::class, 'updateAnnouncement']);
Route::delete ('/announcements/{id}', [AnnouncementController::class, 'destroy']);


//Saji
Route::get('/salaryadvance', [SalarayAdvanceController::class, 'getAllSalaryAdvances']);
Route::get('/salaryadvance/{id}', [SalarayAdvanceController::class, 'getSalaryAdavanceInfo']);
Route::post('/salaryadvance', [SalarayAdvanceController::class, 'saveSalaryAdvance']);
Route::put('/salaryadvance/{id}', [SalarayAdvanceController::class, 'updateSalaryAdvance']);
Route::delete('/salaryadvance/{id}', [SalarayAdvanceController::class, 'destroySalaryAdvance']);

Route::get ('/allowedleaves', [AllowedLeaveController::class, 'getAllAllowedLeaves']);
Route::get ('/allowedleaves/{id}', [AllowedLeaveController::class, 'getAllowedLeavesinfo']);
Route::POST('/allowedleaves', [AllowedLeaveController::class, 'saveAllowedLeaves']);
Route::put ('/allowedleaves/{id}', [AllowedLeaveController::class, 'updateAllowedLeaves']);
Route::delete ('/allowedleaves/{id}', [AllowedLeaveController::class, 'destroyAllowedLeaves']);

Route::get ('/leave_requests', [LeaveRequestController::class, 'getAllLeave_requests']);
Route::get ('/leave_requests/{id}', [LeaveRequestController::class, 'getAllLeave_requestInfo']);
Route::POST('/leave_requests', [LeaveRequestController::class, 'saveLeave_requestInfo']);
Route::put ('/leave_requests/{id}', [LeaveRequestController::class, 'updateLeave_requestInfo']);
Route::delete ('/leave_requests/{id}', [LeaveRequestController::class, 'destroyLeave_request']);
//saji
//aparnan
Route::get ('/leavetypes', [LeaveTypeController::class, 'getAllLeaveTypes']);
Route::get ('/leavetypes/{id}', [LeaveTypeController::class, 'getLeaveTypesinfo']);
Route::POST('/leavetypes', [LeaveTypeController::class, 'saveLeaveTypes']);
Route::put ('/leavetypes/{id}', [LeaveTypeController::class, 'updateLeaveTypes']);
Route::delete ('/leavetypes/{id}', [LeaveTypeController::class, 'destroyLeaveTypes']);

Route::get ('/shortLeaves', [ShortLeavesController::class, 'getAllShortLeave']);
Route::get ('/shortLeaves/{id}', [ShortLeavesController::class, 'getShortLeaveInfo']);
Route::POST('/shortLeaves', [ShortLeavesController::class, 'saveShortLeave']);
Route::put ('/shortLeaves/{id}', [ShortLeavesController::class, 'updateShortLeave']);
Route::delete ('/shortLeaves/{id}', [ShortLeavesController::class, 'destroyShortLeave']);

Route::get ('/EmployeeQualifications', [EmployeeQualificationsController::class, 'getAllEmployeeQualifications']);
Route::get ('/EmployeeQualifications/{id}', [EmployeeQualificationsController::class, 'getEmployeeQualifications']);

Route::get('/attendance', [AttendanceController::class, 'getAllAttendance']);
Route::get('/attendance/{id}', [AttendanceController::class, 'getAttendanceinfo']);
Route::post('/attendance', [AttendanceController::class, 'saveAttendance']);
Route::put('/attendance/{id}', [AttendanceController::class, 'updateAttendance']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroyAttendance']);

Route::get ('/recruitmentcandidates', [RecruitmentCandidateController::class, 'getAllRecruitmentCandidates']);
Route::get ('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'getRecruitmentCandidateInfo']);
Route::POST('/recruitmentcandidates', [RecruitmentCandidateController::class, 'saveRecruitmentCandidates']);
Route::put ('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'updateRecruitmentCandidates']);
Route::delete ('/recruitmentcandidates/{id}', [RecruitmentCandidateController::class, 'destroyRecruitmentCandidates']);

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


//achuthan
//jathusan
Route::get ('/work-shifts', [EmployeeWorkShiftController::class, 'index']);
Route::get ('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'edit']);
Route::POST('/work-shifts', [EmployeeWorkShiftController::class, 'store']);
Route::put ('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'update']);
Route::delete ('/work-shifts/{id}', [EmployeeWorkShiftController::class, 'destory']);

Route::get('/promotions', [PromotionsController::class, 'getAllPromotions']);
Route::get('/promotions/{id}', [PromotionsController::class, 'getPromotionInfo']);
Route::post('/promotions', [PromotionsController::class, 'savePromotion']);
Route::put('/promotions/{id}', [PromotionsController::class, 'updatePromotion']);
Route::delete('/promotions/{id}', [PromotionsController::class, 'destroyPromotion']);


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

Route::get('/EmployeeBenefitType', [EmployeeBenefitTypeController::class,'index']);
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



