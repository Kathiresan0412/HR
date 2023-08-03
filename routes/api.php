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

Route::get('/salarytypes',[SalaryTypeController::class, 'getAllSalaryType']);
Route::get('/salarytypes/{id}',[SalaryTypeController::class, 'getSalaryTypeInfo']);
Route::post('/salarytypes',[SalaryTypeController::class, 'saveSalaryType']);
Route::put('/salarytypes/{id}',[SalaryTypeController::class, 'updateSalaryType']);
Route::delete('/salarytypes/{id}',[SalaryTypeController::class, 'destory']);

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


//check
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

Route::get ('/leavere_quests', [LeaveRequestController::class, 'getAllLeave_requests']);
Route::get ('/leavere_quests/{id}', [LeaveRequestController::class, 'getAllLeave_requestInfo']);
Route::POST('/leavere_quests', [LeaveRequestController::class, 'saveLeave_requestInfo']);
Route::put ('/leavere_quests/{id}', [LeaveRequestController::class, 'updateLeave_requestInfo']);
Route::delete ('/leavere_quests/{id}', [LeaveRequestController::class, 'destroyLeave_request']);

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

//must check

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

Route::get ('/instructors', [ResignationsController::class, 'index']);
Route::get ('/instructors/{id}', [ResignationsController::class, 'edit']);
Route::POST('/instructors', [ResignationsController::class, 'store']);
Route::put ('/instructors/{id}', [ResignationsController::class, 'update']);
Route::delete ('/instructors/{id}', [ResignationsController::class, 'destory']);

