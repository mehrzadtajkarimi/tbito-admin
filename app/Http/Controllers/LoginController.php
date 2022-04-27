<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\AdminLoginLog;
use App\Helpers\TableCodeHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login.index');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {


        # find admin
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->with('error', 'اطلاعات کاربری یافت نشد!')->withInput();
        }

        # check password
        if (!Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'اطلاعات کاربری یافت نشد!!')->withInput();
        }

        # check enabled
        if (!$admin->enabled) {
            return back()->with('error', 'حساب کاربری شما غیر فعال شده است !')->withInput();
        }

        # request to core
        $coreApiUrl = env('CORE_API_V1') . "/admin/auth/token";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->post($coreApiUrl, [
            'admin_code' => TableCodeHelper::id2Code($admin->id),
            'password' => $request->password,
            'otp' => $request->otp,
        ]);

        if ($response['success']) {
            Cookie::queue('tbat', $response['data']['user_token'], 720);
            auth('admin')->loginUsingId($admin->id);

            AdminLoginLog::insert([
                'admin_id' => auth('admin')->user()->id,
                'user_agent' => $request->header('User-Agent'),
                'ip_address' => $request->ip(),
                'date' => Carbon::now()->timestamp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect("/");
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg)->withInput();
        }
    }


    public function logout()
    {
        # request to core
        $coreApiUrl = env('CORE_API_V1') . "/admin/logout";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl);

        if ($response['success']) {
            Cookie::queue(Cookie::forget('tbat'));
            Auth::guard('admin')->logout();
            return redirect('login');
        } else {
            return back()->with('error', 'خطا در سرور!!!')->withInput();
        }
    }
}
