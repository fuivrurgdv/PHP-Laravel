<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function showWorkTime()
    {
        $checkInTime = Setting::where('key', 'working_start')->value('value');
        $checkOutTime = Setting::where('key', 'working_end')->value('value');

        return view('attendances.setting', compact('checkInTime', 'checkOutTime'));
    }

    public function updateWorkTime(Request $request)
    {
        Setting::where('key', 'working_start')->update(['value' => $request->input('working_start')]);
        Setting::where('key', 'working_end')->update(['value' => $request->input('working_end')]);

        return redirect()->back()->with('message', 'Giờ check-in và check-out đã được cập nhật!');
    }}