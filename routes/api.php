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

<<<<<<< HEAD
Route::get('/positions', [PositionController::class, 'index']);
Route::get('/positions/{id}', [PositionController::class, 'edit']);
Route::post('/positions', [PositionController::class, 'store']);
Route::put('/positions/{id}', [PositionController::class, 'update']);
Route::delete('/positions/{id}', [PositionController::class, 'destory']);

Route::get('/salarytypes', [SalaryTypeController::class, 'index']);
Route::get('/salarytypes/{id}', [SalaryTypeController::class, 'edit']);
Route::post('/salarytypes', [SalaryTypeController::class, 'store']);
Route::put('/salarytypes/{id}', [SalaryTypeController::class, 'update']);
Route::delete('/salarytypes/{id}', [SalaryTypeController::class, 'destory']);

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
=======
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
>>>>>>> c4564c3ed37b799bc9ea416fdd63d4420d0d2198

Route::get('/employees', [EmployeesController::class, 'index']);
Route::get('/employees/{id}', [EmployeesController::class, 'edit']);
Route::POST('/employees', [EmployeesController::class, 'store']);
Route::put('/employees/{id}', [EmployeesController::class, 'update']);
Route::delete('/employees/{id}', [EmployeesController::class, 'destroy']);

<<<<<<< HEAD
Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::get('/announcements/{id}', [AnnouncementController::class, 'edit']);
Route::POST('/announcements', [AnnouncementController::class, 'store']);
Route::put('/announcements/{id}', [AnnouncementController::class, 'update']);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);
=======
Route::get('/announcements', [AnnouncementController::class, 'getAll']);
Route::get('/announcements/{id}', [AnnouncementController::class, 'getOne']);
Route::POST('/announcements', [AnnouncementController::class, 'save']);
Route::put('/announcements/{id}', [AnnouncementController::class, 'update']);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'delete']);
>>>>>>> c4564c3ed37b799bc9ea416fdd63d4420d0d2198

Route::get('/salaryadvance', [SalarayAdvanceController::class, 'getAll']);
Route::get('/salaryadvance/{id}', [SalarayAdvanceController::class, 'getOne']);
Route::post('/salaryadvance', [SalarayAdvanceController::class, 'save']);
Route::put('/salaryadvance/{id}', [SalarayAdvanceController::class, 'update']);
Route::delete('/salaryadvance/{id}', [SalarayAdvanceController::class, 'delete']);

<<<<<<< HEAD
Route::get('/allowedleaves', [AllowedLeaveController::class, 'index']);
Route::get('/allowedleaves/{id}', [AllowedLeaveController::class, 'edit']);
Route::POST('/allowedleaves', [AllowedLeaveController::class, 'store']);
Route::put('/allowedleaves/{id}', [AllowedLeaveController::class, 'update']);
Route::delete('/allowedleaves/{id}', [AllowedLeaveController::class, 'destroy']);
=======
Route::get ('/allowed-leaves', [AllowedLeaveController::class, 'getAll']);
Route::get ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'getOne']);
Route::POST('/allowed-leaves', [AllowedLeaveController::class, 'save']);
Route::put ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'update']);
Route::delete ('/allowed-leaves/{id}', [AllowedLeaveController::class, 'delete']);
>>>>>>> c4564c3ed37b799bc9ea416fdd63d4420d0d2198

Route::get('/leave_requests', [LeaveRequestController::class, 'index']);
Route::get('/leave_requests/{id}', [LeaveRequestController::class, 'edit']);
Route::POST('/leave_requests', [LeaveRequestController::class, 'store']);
Route::put('/leave_requests/{id}', [LeaveRequestController::class, 'update']);
Route::delete('/leave_requests/{id}', [LeaveRequestController::class, 'destroy']);

<<<<<<< HEAD
Route::get('/leave-types', [LeaveTypeController::class, 'index']);
Route::get('/leave-types/{id}', [LeaveTypeController::class, 'edit']);
Route::POST('/leave-types', [LeaveTypeController::class, 'store']);
Route::put('/leave-types/{id}', [LeaveTypeController::class, 'update']);
Route::delete('/leave-types/{id}', [LeaveTypeController::class, 'destroy']);



Route::get('/EmployeeQualifications', [EmployeeQualificationsController::class, 'index']);
Route::get('/EmployeeQualifications/{id}', [EmployeeQualificationsController::class, 'edit']);
=======
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
>>>>>>> c4564c3ed37b799bc9ea416fdd63d4420d0d2198

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
<<<<<<< HEAD
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
=======

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
>>>>>>> c4564c3ed37b799bc9ea416fdd63d4420d0d2198
//sangi
Route::get('/ots', [OTSController::class, 'getAll']);
Route::get('/ots/{id}', [OTSController::class, 'getOne']);
Route::post('/ots', [OTSController::class, 'save']);
Route::put('/ots/{id}', [OTSController::class, 'update']);
Route::delete('/ots/{id}', [OTSController::class, 'delete']);

<<<<<<< HEAD
=======
Route::get('/EmployeeBenefitType', [EmployeeBenefitTypeController::class, 'index']);
Route::get('/EmployeeBenefitType/{id}', [EmployeeBenefitTypeController::class, 'edit']);
Route::post('/EmployeeBenefitType', [EmployeeBenefitTypeController::class, 'store']);
Route::put('/EmployeeBenefitType/{id}', [EmployeeBenefitTypeController::class, 'update']);
Route::delete('/EmployeeBenefitType/{id}', [EmployeeBenefitTypeController::class, 'destory']);

>>>>>>> c4564c3ed37b799bc9ea416fdd63d4420d0d2198


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

Route::get('/EmployeeDisciplinary', [EmployeeDisciplinaryController::class, 'index']);
Route::get('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'edit']);
Route::post('/EmployeeDisciplinary', [EmployeeDisciplinaryController::class, 'store']);
Route::put('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'update']);
Route::delete('/EmployeeDisciplinary/{id}', [EmployeeDisciplinaryController::class, 'destory']);
