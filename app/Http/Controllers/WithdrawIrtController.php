<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Withdraw;
use App\Helpers\JDateHelper;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\TableCodeHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class WithdrawIrtController extends Controller
{



    public function index(User $user, Request $request)
    {
        $this->authorize('withdraws-irt-read');
        $data['withdraws'] = Withdraw::query();

        // return $request->all();
        if ($request->filled('id')) {
            $data['withdraws']->where('id', $request->id);
        }
        if ($request->filled('code')) {
            $id = TableCodeHelper::code2Id($request->code);
            $data['withdraws']->where('id', $id);
        }
        if ($request->filled('user')) {
            $keyword = GlobalHelper::exchangeArabicChars($request->user);
            $keyword_array = explode(' ', trim($keyword));
            $data['withdraws']->whereHas('user', function ($q) use ($keyword_array) {
                for ($i = 0; $i < count($keyword_array); $i++) {
                    $keyword_i = $keyword_array[$i];
                    $q->where(function ($query) use ($keyword_i) {
                        $query->orWhere('firstname', 'LIKE', "%{$keyword_i}%");
                        $query->orWhere('lastname', 'LIKE', "%{$keyword_i}%");
                        $query->orWhere('email', 'LIKE', "%{$keyword_i}%");
                        $query->orWhere('mobile', $keyword_i);
                        $query->orWhere('national_code', $keyword_i);
                        $query->orWhere('id', TableCodeHelper::code2id($keyword_i));
                    });
                }
            });
        }
        if ($request->filled('status')) {
            $data['withdraws']->where('status', $request->status);
        }
        if ($request->filled('creationType')) {
            $data['withdraws']->where('creation_type', $request->creationType);
        }
        if ($request->filled('trackingCode')) {
            $data['withdraws']->where('tracking_code', $request->trackingCode);
        }

        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $startDateCarbon = Carbon::createFromTimestamp($startDateTimestamp);
            $data['withdraws']->where('created_at', '>=', $startDateCarbon);
            // $data['deposits']->where('created_at', '>=', $startDateCarbon)->orWhere('confirmed_by_site_at', '>=', $startDateCarbon);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $finishDateCarbon = Carbon::createFromTimestamp($finishDateTimestamp);
            $data['withdraws']->where('created_at', '<=', $finishDateCarbon);
            // $data['deposits']->where('created_at', '<=', $finishDateCarbon)->orWhere('confirmed_by_site_at', '<=', $finishDateCarbon);
        }





        $data['withdraws'] = $data['withdraws']->with(['user', 'bankAccount'])->where('type', 1)->latest()->paginate()->appends($request->query());
        // return $data['withdraws'];
        return view('withdrawIrt.all', compact('data'));
    }


    public function checkWallet($userId)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-wallet-read');
        $this->authorize('withdraws-irt-read');


        $coreApiUrl = env('CORE_API_V1') . "/admin/user-wallets/check";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'user_id' => $userId
        ]);
        $response = json_decode($response, true);
        return $response;
    }
    public function checkWalletWithdraw($withdrawId)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-wallet-read');
        $this->authorize('withdraws-irt-read');

        $coreApiUrl = env('CORE_API_V1') . "/admin/withdraw/check";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'withdraw_id' => $withdrawId
        ]);
        $response = json_decode($response, true);
        return $response;
    }


    public function confirm($withdrawId)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-wallet-read');
        $this->authorize('withdraws-irt-read');
        $this->authorize('withdraws-irt-confirmation');

        $coreApiUrl = env('CORE_API_V1') . "/admin/withdraw/confirm";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'withdraw_id' => $withdrawId
        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg);
        }
    }
    public function unconfirm($withdrawId, Request $request)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-wallet-read');
        $this->authorize('withdraws-irt-read');
        $this->authorize('withdraws-irt-confirmation');

        $coreApiUrl = env('CORE_API_V1') . "/admin/withdraw/cancel";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'withdraw_id' => $withdrawId,
            'description' => $request->unConfirmTextarea
        ]);
        if ($response['success']) {
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg);
        }
    }


    public function paymentInfo($withdrawId, Request $request)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-wallet-read');
        $this->authorize('withdraws-irt-read');

        $coreApiUrl = env('CORE_API_V1') . "/admin/withdraw/done";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'withdraw_id' => $withdrawId,
            'tracking_code' => $request->tracking_code,
            'fee' => $request->fee,
        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg);
        }
    }
    public function internalTransfer($withdrawId)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-wallet-read');
        $this->authorize('withdraws-irt-read');

        $coreApiUrl = env('CORE_API_V1') . "/admin/withdraw/internal";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'withdraw_id' => $withdrawId,
        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg);
        }
    }

    // کاربران (ثبت سند حسابداری)
    public function manualUserWithdrawIrt(User $user, Request $request)
    {
        $this->authorize('user-wallet-read');
        $this->authorize('user-wallet-manual-deposit-withdraw');




        $request->validate([
            'withdraw_currency' => 'required',
            'withdraw_amount' => 'required',
            'withdraw_description' => 'required',
        ]);





        $coreApiUrl = env('CORE_API_V1') . "/admin/user-balance/decrease";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'user_id' => $user->id,
            'currency_id' => $request->withdraw_currency,
            'amount' => $request->withdraw_amount,
            'description' => $request->withdraw_description,
            'tradable' => $request->withdraw_tradable == 'on' ? 1 : 0,
        ]);
        if ($response['success']) {
            return redirect()->route('user.show', $user->id)->with('success',  $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return redirect()->route('user.show', $user->id)->with('error', $msg);
        }
    }
}
