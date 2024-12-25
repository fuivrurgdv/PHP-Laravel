<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\User_attendanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestExcelController;
use App\Exports\UsersExport;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AdminLeaveRequestController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AnotherChartController;
use App\Models\Payroll;
use App\Models\Setting;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::middleware('web')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    //     ->name('password.request');
    // Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    //     ->name('password.email');
});
Route::post('users/import/', [UserController::class, 'importPost'])->name('users.import');
Route::get('/export-users', [UserController::class, 'export'])->name('users.export');
Route::get('/export-template', [UserController::class, 'exportTemplate'])->name('export.template');

// Department routes (role = 1)
Route::middleware('auth')->group(function () {
    Route::get('/departments', [DepartmentController::class, 'allDepartment'])->name('departments');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{id}/members', [DepartmentController::class, 'showMembers'])->name('departments.show');
    Route::patch('/departments/{id}/update-status', [DepartmentController::class, 'updateStatus'])
        ->name('departments.updateStatus');
    Route::get('/departments/{id}/sub-departments', [DepartmentController::class, 'showSubDepartments'])->name('departments.subDepartments');
    Route::get('/departments/search', [DepartmentController::class, 'search'])->name('departments.search');
});

// User management routes
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::post('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/{id}/quick-update', [UserController::class, 'update'])->name('users.quickUpdate');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/detail', [UserController::class, 'showDetail'])->name('users.detail');
    Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('users.edit');
    Route::post('/users/{id}/update-detail', [UserController::class, 'updateUser'])->name('users.updatedetail');


});

// Attendance routes (role = 2)
Route::middleware('auth')->group(function () {
    Route::get('/attendance', [User_attendanceController::class, 'index'])->name('attendance');
    Route::post('/check-in', [User_attendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/check-out', [User_attendanceController::class, 'checkOut'])->name('attendance.checkout');
    Route::get('/attendance/monthly-report', [User_attendanceController::class, 'monthlyReport'])
        ->name('attendance.monthlyReport');
    Route::get('/attendance/allUser', [User_attendanceController::class, 'reportAllUsers'])->name('attendance.all');
    Route::get('/attendance/department-report', [User_attendanceController::class, 'departmentReport'])->name('department.report');
    Route::get('/attendance/search', [User_attendanceController::class, 'searchByDepartment'])->name('attendance.search');
    
    Route::post('/attendance/submit-reason/{attendance}', [User_attendanceController::class, 'submitReason'])->name('attendance.submit-reason');
    Route::get('/attendance/requests', [User_attendanceController::class, 'pendingRequests'])->name('attendance.requests');
    Route::post('/attendance/requests/{id}/accept', [User_attendanceController::class, 'acceptRequest'])->name('attendance.requests.accept');
    Route::post('/attendance/requests/{id}/reject', [User_attendanceController::class, 'rejectRequest'])->name('attendance.requests.reject');
});

// Route::get('/users/export', function () {
//     dd('Export route is called'); // Kiểm tra xem route có được gọi hay không
//     return Excel::download(new UsersExport, 'users.xlsx');
// });
Route::middleware('auth')->group(function () {
    Route::get('/setting', [SettingController::class, 'showWorkTime'])->name('setting');
    Route::post('/setting/update', [SettingController::class, 'updateWorkTime'])->name('setting.update');
    Route::post('/send-reminders', [SettingController::class, 'sendReminders'])
        ->name('send.reminders');
 });

 Route::middleware('auth')->group(function () {
    Route::get('/payroll/calculate', [PayrollController::class, 'showPayrollForm'])->name('payroll.form');
    Route::post('/payroll/calculate', [PayrollController::class, 'calculatePayroll'])->name('payroll.calculate');
    Route::post('/payroll/store', [PayrollController::class, 'storePayroll'])->name('payroll.store');
    Route::get('/payrolls', [PayrollController::class, 'showPayrolls'])->name('payrolls.index');
    Route::get('/run-payroll-calculate', function () {
        $exitCode = Artisan::call('payroll:calculate', ['--testTime' => '24:00:00']);
        return redirect()->back()->with('success', 'Tính lương cho tất cả nhân viên thành công!');
    })->name('run.payroll.calculate');

 });

//  Route::middleware('auth')->group(function () {
//     Route::get('/chart', [ChartController::class, 'chartView'])->name('chart.view');
//     Route::get('/api/user-count-by-department', [ChartController::class, 'getUserCountByDepartment']);
//     Route::get('/employee-ratio', [ChartController::class, 'employeeRatioView'])->name('employee.ratio');
//     Route::get('/api/gender-ratio-by-department}', [ChartController::class, 'getGenderRatioByDepartment']);
//     Route::get('/gender-ratio', [ChartController::class, 'genderRatioView'])->name('gender.ratio');
// });

Route::middleware('auth')->group(function () {
    Route::get('/charts-another', [AnotherChartController::class, 'index'])->name('charts.index');

    Route::get('/chart-view', [ChartController::class, 'chartView'])->name('chart.view');
    Route::get('/chart-view-test', [ChartController::class, 'view'])->name('view.view');
    Route::get('/api/total-employees', [ChartController::class, 'getTotalEmployees']);


    Route::get('/api/employee-ratio-by-department', [ChartController::class, 'getEmployeeRatioByDepartment']);
    Route::get('/api/age-gender-stats-by-department', [ChartController::class, 'getAgeGenderStatsByDepartment']);
    Route::get('/api/attendance-stats', [ChartController::class, 'getAttendanceStats']);
    Route::get('/api/contract-type-by-department', [ChartController::class, 'getContractTypeByDepartment']);
    Route::get('/api/gender-statistics', [ChartController::class, 'genderStatistics']);
    Route::get('/api/departments', [ChartController::class, 'getDepartments']);
    Route::get('/attendance-stats', [ChartController::class, 'getAttendanceStats']);
});
Route::middleware('auth')->group(function () {
    // Route::resource('reasons', ReasonController::class);
    // Route::get('/reasons', [ReasonController::class, 'index'])->name('reasons.index');
    Route::get('/manage-leave_requests', [AdminLeaveRequestController::class, 'index'])->name('admin_leave_requests.index');
    Route::put('/manage-leave_requests/{id}/status', [AdminLeaveRequestController::class, 'updateStatus'])->name('admin_leave_requests.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::post('/leave-request', [LeaveRequestController::class, 'store'])->name('leave.request');
    Route::get('/leave-requests/view', [LeaveRequestController::class, 'index'])->name('leave_requests.index');
    Route::get('/leave-requests/create', [LeaveRequestController::class, 'create'])->name('leave_requests.create');
    // Route::post('/leave-requests', [LeaveRequestController::class, 'store'])->name('leave_requests.store');
    Route::get('/leave-requests/{id}/edit', [LeaveRequestController::class, 'edit'])->name('leave_requests.edit');
    Route::put('/leave-requests/{id}', [LeaveRequestController::class, 'update'])->name('leave_requests.update');
    Route::delete('/leave-requests/{id}', [LeaveRequestController::class, 'destroy'])->name('leave_requests.destroy');
});


Route::middleware('auth')->group(function () {
   Route::get('/salary',[SalaryController::class, 'index'])->name('salary');
   Route::get('/salary/create',[SalaryController::class, 'create'])->name('salary.create');
   Route::post('/salary',[SalaryController::class, 'store'])->name('salary.store');
   Route::get('/salary/{id}',[SalaryController::class, 'show'])->name('salary.show');
   Route::get('/salary/{id}/edit',[SalaryController::class, 'edit'])->name('salary.edit');
   Route::put('/salary/{id}/update',[SalaryController::class, 'update'])->name('salary.update');
});
