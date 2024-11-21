<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings'; // Tên bảng trong CSDL
    protected $fillable = ['key', 'value']; // Các cột có thể thao tác
    

public function checkValidity()
{
    $today = now()->startOfDay()->timestamp;

    // Lấy giờ làm việc từ cơ sở dữ liệu
    $startHour = DB::table('settings')->where('key', 'working_start')->value('value');
    $endHour = DB::table('settings')->where('key', 'working_end')->value('value');

    // Tìm bản ghi check-in và check-out gần nhất của người dùng
    $checkIn = User_attendance::where('user_id', $this->user_id)
        ->where('type', 'in')
        ->orderBy('time', 'desc')
        ->first();

    $checkOut = User_attendance::where('user_id', $this->user_id)
        ->where('type', 'out')
        ->orderBy('time', 'desc')
        ->first();

    // Kiểm tra nếu cả hai bản ghi check-in và check-out tồn tại
    if ($checkIn && $checkOut) {
        $checkInTime = $checkIn->time->format('H:i');
        $checkOutTime = $checkOut->time->format('H:i');

        // Kiểm tra điều kiện thời gian hợp lệ
        if ($checkInTime > $startHour && $checkOutTime < $endHour) {
            $this->status = 1; // Hợp lệ
        } else {
            $this->status = 0; // Không hợp lệ
        }

        // Lưu trạng thái đã cập nhật vào cơ sở dữ liệu
        $this->save();
    }
}

}
