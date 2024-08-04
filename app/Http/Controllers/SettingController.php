<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;

class SettingController extends Controller
{
    public function fines()
    {
        $arr['setting'] = Setting::find(1); 
        return view('setting.feesAndDuration')->with($arr);
    }

    public function updateFines(Request $request)
    {
        $settings = Setting::find(1);

        $settings->fees = $request->fees;
        $settings->fees_duration = $request->fees_duration;
        $settings->save();

        return back()->with('toast_success', 'Update settings successfully');
    }

    public function period()
    {
        $arr['setting'] = Setting::find(1); 
        return view('setting.periodAndLength')->with($arr);
    }

    public function updatePeriod(Request $request)
    {
        $settings = Setting::find(1);

        $settings->no_of_books_per_member = $request->perMember;
        $settings->no_of_days_for_lending = $request->lendingDays;
        $settings->save();

        return back()->with('toast_success', 'Update settings successfully');
    }

    public function user()
    {
        $arr['user'] = User::whereNotIn('name', ['supuser'])->orderBy('name')->get();

        return view('setting.userList')->with($arr);
    }

    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->id);

        $user->role = $request->has('admin') ? 0 : 1;
        $user->save();

        return back()->with('toast_success', 'Update user role successfully');
    }

    public function idPrefix()
    {
        $arr['prefix'] = Setting::find(1);

        return view('setting.idPrefix')->with($arr);
    }

    public function updateIdPrefix(Request $request)
    {
        $settings = Setting::find(1);

        $settings->id_code_prefix = $request->prefix;
        $settings->id_capacity = $request->capacity;
        $settings->id_address_default = $request->address;
        $settings->save();

        return back()->with('toast_success', 'Update setting successfully');
    }

    public function printCode()
    {
        $arr['setting'] = Setting::find(1); 
        
        return view('setting.printCodeCount')->with($arr);
    }

    public function updatePrintCode(Request $request)
    {
        $settings = Setting::find(1);

        $settings->no_of_code_per_page = $request->codeCount;
        $settings->no_of_qrcode_per_page = $request->QRcodeCount;
        $settings->save();

        return back()->with('toast_success', 'Update settings successfully');
    }
}
