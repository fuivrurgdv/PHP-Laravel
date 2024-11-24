<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\User_attendance;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class User_attendanceController extends Controller
{
    // Phương thức hiển thị lịch sử chấm công của người dùng
    public function index()
    {
        $query = User_attendance::where('user_id', Auth::id());
        $attendances = $query->orderBy('created_at', 'desc') // Sắp xếp theo thời gian mới nhất
            ->paginate(5); // Phân trang, mỗi trang có 5 bản ghi
        return view('attendances.users_attendance', compact('attendances'));
    }

    // Phương thức check in
    public function checkIn()
    {
        $user = Auth::user();
        $latestAttendance = User_attendance::where('user_id', $user->id)
            ->orderBy('time', 'desc')
            ->first();



        if (!$latestAttendance || $latestAttendance->type === 'out') {

            $working_start = Carbon::parse(Setting::where('key', 'working_start')->value('value'));
            $working_end = Setting::where('key', 'working_end')->value('value');
            $currentTime = now()->timezone('Asia/Ho_Chi_Minh');

            $status = 1;

            if ($currentTime->lt($working_start)) {
                $status = 1;
            } else {
                $status = 0;
            }

            $attendance = User_attendance::create([
                'time' => $currentTime,
                'type' => 'in',
                'user_id' => $user->id,
                'status' => $status,
                'justification' => '',
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            // Check validity
            $attendance->save();

            return redirect()->back()->with('message', 'Đã Check in.');
        } else {
            return redirect()->back()->with('message', 'Không thể Check in');
        }
    }

    public function checkOut()
    {
        $user = Auth::user();
        $latestAttendance = User_attendance::where('user_id', $user->id)
            ->orderBy('time', 'desc')
            ->first();


        if ($latestAttendance && $latestAttendance->type === 'in') {

            $working_start = Carbon::parse(Setting::where('key', 'working_start')->value('value'));
            $working_end = Setting::where('key', 'working_end')->value('value');
            $currentTime = now()->timezone('Asia/Ho_Chi_Minh');

            $checkInTime = $latestAttendance->created_at;
            $checkOutTime = now()->timezone('Asia/Ho_Chi_Minh');
            
            $status = 1;

            if ($currentTime->gt($working_end)) {
                $status = 1;
            } else {
                $status = 0;
            }
            $attendance = User_attendance::create([
                'time' => $checkOutTime,
                'type' => 'out',
                'user_id' => $user->id,
                'status' => $status,
                'justification' => '',
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            // Check validity
            $attendance->save();

            return redirect()->back()->with('message', 'Đã Check out .');
        } else {
            return redirect()->back()->with('message', 'Bạn chưa Check In, không thể Check Out!');
        }
    }

    public function submitReason(Request $request, User_Attendance $attendance)
    {
        // Xử lý lý do giải trình
        $reason = $request->reason; // Lý do từ radio button

        // Nếu lý do là "other", sử dụng nội dung từ custom_reason
        if ($reason === 'other') {
            $reason = $request->custom_reason;
        }

        // Lưu lý do giải trình và cập nhật trạng thái
        $attendance->user_id = auth()->id();
        $attendance->justification = $reason;
        $attendance->status = 3; // Đang xem xét
        $attendance->save();

        // Gửi email xác nhận
        $name = auth()->user()->name;
        Mail::send('email.email_reminder', compact('name'), function ($email) {
            $user_email = auth()->user()->email;
            $email->subject('Đơn bạn đã nộp thành công!');
            $email->to($user_email, 'abc');
        });

        // Điều hướng lại và hiển thị thông báo
        return redirect()->back()->with('success', 'Lý do đã được gửi!');
    }


    public function pendingRequests()
    {
        // Lấy các bản ghi `check-out` có `status = 3`
        $pendingRequests = User_Attendance::where('status', 3)
            ->where('type', 'out')
            ->orWhere('type', 'in')
            ->paginate(5);

        return view('attendances.request', compact('pendingRequests'));
    }



    public function acceptRequest($id)
    {
        $request = User_Attendance::findOrFail($id);
        $user = $request->user;
        $request->status = 1; // Đặt status về hợp lệ
        $request->save();
        $reason = $request->explanation;
        $name = $user->name;

        Mail::send('email.accepted', compact('reason', 'name'), function ($email) use ($user) {
            $email->subject('Đơn bạn đã được chấp nhận!');
            $email->to($user->email);
        });

        return redirect()->route('attendance.requests')->with('success', 'Đơn đã được chấp nhận.');
    }

    public function rejectRequest($id)
    {
        $request = User_Attendance::findOrFail($id);
        $user = $request->user;
        $request->status = 0; // Đặt status về không hợp lệ
        $request->save();
        $reason = $request->explanation;
        $name = $user->name;


        Mail::send('email.rejected', compact('reason', 'name'), function ($email) use ($user) {
            $email->subject('Đơn bạn đã bị từ chối');
            $email->to($user->email, $user->name);
        });

        return redirect()->route('attendance.requests')->with('error', 'Đơn đã bị từ chối.');
    }



    // Phương thức báo cáo hàng tháng
    public function monthlyReport(Request $request)
    {
        $userId = Auth::id();
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $employeeData = [
            'name' => User::find($userId)->name,
            'position' => User::find($userId)->position,
            'attendance' => [],
        ];

        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day);
            $attendances = User_attendance::where('user_id', $userId)
                ->whereDate('time', $date)
                ->orderBy('time')
                ->get();

            if ($attendances->isNotEmpty()) {
                foreach ($attendances as $attendance) {
                    $type = $attendance->type;

                    if (!isset($employeeData['attendance'][$date->toDateString()])) {
                        $employeeData['attendance'][$date->toDateString()] = [
                            'checkIn' => null,
                            'checkOut' => null,
                            'hours' => 0,
                        ];
                    }

                    if ($type === 'in') {
                        $employeeData['attendance'][$date->toDateString()]['checkIn'] = $attendance->time;
                    } elseif ($type === 'out') {
                        $checkInTime = $employeeData['attendance'][$date->toDateString()]['checkIn'];
                        if ($checkInTime !== null) {
                            $checkOutTime = $attendance->time;
                            $hoursWorked = Carbon::parse($checkInTime)->diffInHours(Carbon::parse($checkOutTime));
                            $employeeData['attendance'][$date->toDateString()]['checkOut'] = $checkOutTime;
                            $employeeData['attendance'][$date->toDateString()]['hours'] = $hoursWorked;
                        }
                    }
                }
            }
        }

        return view('attendances.monthly_report', compact('employeeData', 'month', 'year'));
    }




    // Phương thức báo cáo cho phòng ban
    public function departmentReport(Request $request)
    {
        $departments = Department::where('parent_id', 0)->get();
        $selectedDepartmentIds = (array)$request->input('department_ids', []);
        $selectedSubDepartment = $request->input('sub_department_id', '');

        $subDepartments = $selectedDepartmentIds
            ? Department::whereIn('parent_id', $selectedDepartmentIds)->get()
            : [];

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $singleDate = $request->input('single_date');

        $query = User_attendance::with('user')
            ->whereHas('user', function ($query) use ($selectedDepartmentIds, $selectedSubDepartment) {
                if ($selectedDepartmentIds) {
                    $query->whereIn('department_id', $selectedDepartmentIds);
                }
                if ($selectedSubDepartment) {
                    $query->orWhere('department_id', $selectedSubDepartment);
                }
            });

        // Áp dụng lọc ngày và phân trang
        $attendanceData = $this->filterByDate($query, $startDate, $endDate, $singleDate)
            ->orderBy('time', 'asc')
            ->paginate(10); // Chia thành 10 bản ghi mỗi trang
        // Rest of the monthly report logic
        $monthlyReport = [];
        foreach ($attendanceData as $attendance) {
            $userId = $attendance->user_id;
            $date = $attendance->time->format('Y-m-d');
            $type = $attendance->type;

            if (!isset($monthlyReport[$userId])) {
                $monthlyReport[$userId] = [
                    'name' => $attendance->user->name,
                    'position' => $attendance->user->position ?? 'N/A',
                    'dailyHours' => [],
                    'totalHours' => 0,
                ];
            }

            if (!isset($monthlyReport[$userId]['dailyHours'][$date])) {
                $monthlyReport[$userId]['dailyHours'][$date] = [];
            }

            if ($type === 'in') {
                $monthlyReport[$userId]['dailyHours'][$date][] = [
                    'checkIn' => $attendance->time,
                    'checkOut' => null,
                    'hours' => 0,
                ];
            } elseif ($type === 'out') {
                $lastIndex = count($monthlyReport[$userId]['dailyHours'][$date]) - 1;
                if ($lastIndex >= 0 && !$monthlyReport[$userId]['dailyHours'][$date][$lastIndex]['checkOut']) {
                    $checkInTime = Carbon::parse($monthlyReport[$userId]['dailyHours'][$date][$lastIndex]['checkIn']);
                    $checkOutTime = Carbon::parse($attendance->time);

                    $hoursWorked = $checkInTime->diffInHours($checkOutTime);
                    $monthlyReport[$userId]['dailyHours'][$date][$lastIndex]['checkOut'] = $attendance->time;
                    $monthlyReport[$userId]['dailyHours'][$date][$lastIndex]['hours'] = $hoursWorked;

                    $monthlyReport[$userId]['totalHours'] += $hoursWorked;
                }
            }
        }

        foreach ($monthlyReport as &$report) {
            foreach ($report['dailyHours'] as $dateHours) {
                foreach ($dateHours as $day) {
                    $report['totalHours'] += $day['hours'];
                }
            }
            $report['monthlyTotalHours'] = $report['totalHours'];
        }

        return view('attendances.department_report', compact(
            'attendanceData',
            'departments',
            'subDepartments',
            'selectedDepartmentIds',
            'selectedSubDepartment',
            'monthlyReport',
            'startDate',
            'endDate',
            'singleDate'
        ));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'time' => 'required|date_format:H:i',
            'type' => 'required|in:in,out',
            'status' => 'required|boolean',
            'justification' => 'nullable|string',
        ]);

        // Create a new attendance record
        $attendance = User_attendance::create([
            'user_id' => $validatedData['user_id'],
            'time' => strtotime($validatedData['time']),
            'type' => $validatedData['type'],
            'status' => false, // Mặc định là không hợp lệ
            'justification' => $validatedData['justification'],
            'created_by' => auth()->id(),
        ]);

        // Check the validity of the attendance record after creating
        $attendance->checkValidity();

        return redirect()->back()->with('success', 'Đã ghi log thành công.');
    }

    // Phương thức lọc theo ngày
    protected function filterByDate($query, $startDate, $endDate, $singleDate = null)
    {
        if ($singleDate) {
            // Nếu có ngày đơn lẻ, lọc theo ngày đó
            $query->whereDate('time', $singleDate);
        } else {
            // Nếu có khoảng thời gian, lọc theo khoảng thời gian
            if ($startDate) {
                $query->where('time', '>=', $startDate);
            }
            if ($endDate) {
                $query->where('time', '<=', $endDate);
            }
        }
        return $query;
    }
}
