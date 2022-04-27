<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\AdminLoginLog;
use Illuminate\Validation\Rule;
use App\Helpers\TableCodeHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class ProfileController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:admin-self-read')->only(['index']);
    //     $this->middleware('can:admin-self-update')->only(['update']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin-self-read');


        $data['admin'] = auth('admin')->user();
        $data['loginLog'] = AdminLoginLog::orderBy('id', 'desc')->where('admin_id',  $data['admin']->id)->first();
        $data['loginLogs'] = AdminLoginLog::orderBy('id', 'desc')->where('admin_id',  $data['admin']->id)->get();



        if (!$data['admin']->google2fa) {
            if (request()->query('tab') == '2fa' && request()->query('generate-code') == '1') {
                $coreApiUrl = env('CORE_API_V1') . "/admin/google2fa/get";
                $response = Http::withHeaders([
                    'x-api-key' => env('CORE_API_KEY'),
                ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
                    'admin_code' => TableCodeHelper::id2Code($data['admin']->id)
                ]);

                if ($response['success']) {
                    $data['2fa'] = $response['data'];
                } else {
                    $data['2fa']['text'] = "خطا در سرور - مجددا تلاش نمایید.";
                    $data['2fa']['style'] = "warning";
                }
            } else {
                $data['2fa']['text'] = "جهت تولید رمز جدید درخواست ارسال نمایید";
                $data['2fa']['style'] = "warning";
                $data['2fa']['btn'] = route("profile.index", ['tab' => '2fa', 'generate-code' => 1]);
            }
        } else {
            $data['2fa']['text'] = "شما قبلا تنظیمات ورود دو عاملی حساب کاربری تان را انجام داده اید.";
            $data['2fa']['style'] = "info";
        }


        return view('profile.all', compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $adminId)
    {
        $this->authorize('admin-self-update');

        $admin = Admin::findOrFail($adminId);
        $data = $request->validate([
            'name' => ['required', Rule::unique('admins')->ignore($admin->id)],
            'email' => ['required', Rule::unique('admins')->ignore($admin->id)],
        ]);
        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|string|min:6',
            ]);
            $data['password'] = $request->password;
        }
        try {
            $admin->update($data);
        } catch (\Exception $th) {
            return redirect()->route('profile.index')->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }
        return redirect()->route('profile.index')->with('success', 'عملیات با موفقیت انجام شد!');
    }



    public function setGoogle2fa(Request $request)
    {
        $this->authorize('admin-self-update');

        $admin = auth('admin')->user();

        $request->validate([
            'otp' => 'required',
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $admin->password)) {
            return redirect()->route('profile.index', ['tab' => '2fa'])->with('error', 'کلمه عبور یا رمز یک بار مصرف اشتباه است.!!');
        }

        $coreApiUrl = env('CORE_API_V1') . "/admin/google2fa/confirm";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'admin_code' => TableCodeHelper::id2Code($admin->id),
            'password' => $request->password,
            'otp' => $request->otp,
            'otp_code' => $request->otp_code
        ]);
        if ($response['success']) {
            return redirect()->route('profile.index', ['tab' => '2fa'])->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return redirect()->route('profile.index', ['tab' => '2fa'])->with('error', $msg);
        }
    }
}
