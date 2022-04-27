<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Currency;
use App\Models\Deposits;
use App\Models\SiteSetting;
use App\Helpers\JDateHelper;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\TableCodeHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class DepositController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('deposit-read');

        $data['deposits'] = Deposits::query();

        if ($request->filled('code')) {
            $id = TableCodeHelper::code2Id($request->code);
            $data['deposits']->where('id', $id);
        }
        if ($request->filled('id')) {
            $data['deposits']->where('id', $request->id);
        }
        if ($request->filled('status')) {
            $data['deposits']->where('status', $request->status);
        }
        if ($request->filled('user')) {
            $keyword = GlobalHelper::exchangeArabicChars($request->user);
            $keyword_array = explode(' ', trim($keyword));
            $data['deposits']->whereHas('user', function ($q) use ($keyword_array) {
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
        if ($request->filled('txid')) {
            $data['deposits']->where('txid', $request->txid);
        }
        if ($request->filled('creation_type')) {
            $data['deposits']->where('creation_type', $request->creation_type);
        }
        if ($request->filled('currency_id')) {
            $data['deposits']->where('currency_id', $request->currency_id);
        }
        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $startDateCarbon = Carbon::createFromTimestamp($startDateTimestamp);
            $data['deposits']->where('created_at', '>=', $startDateCarbon);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $finishDateCarbon = Carbon::createFromTimestamp($finishDateTimestamp);
            $data['deposits']->where('created_at', '<=', $finishDateCarbon);
        }


        $data['deposits'] = $data['deposits']->with(['user', 'gateway', 'currency'])->where('type', 2)->latest()->paginate()->appends($request->query());
        $data['currencies'] = Currency::where('id' ,'<>', 1)->get();

        return view('deposits.all', compact('data'));
    }


    public function confirm(Request $request)
    {
        $this->authorize('deposit-read');
        $this->authorize('deposit-confirmation');
        $coreApiUrl = env('CORE_API_V1') . "/admin/deposit/confirm";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'deposit_id' => $request->hidden_id_confirm,
        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return redirect()->route('deposits.index')->with('error', $msg);
        }
    }
    public function unconfirm(Request $request)
    {
        $this->authorize('deposit-read');
        $this->authorize('deposit-confirmation');
        $coreApiUrl = env('CORE_API_V1') . "/admin/deposit/unconfirm";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'deposit_id' => $request->hidden_id_unconfirm,
            'description' => $request->unConfirmTextarea,
        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return redirect()->route('deposits.index')->with('error', $msg);
        }
    }

    // کاربران (ثبت سند حسابداری)
    public function manualUserDeposit(User $user, Request $request)
    {
        $this->authorize('user-wallet-read');
        $this->authorize('user-wallet-manual-deposit-withdraw');





        $request->validate([
            'deposit_currency' => 'required',
            'deposit_amount' => 'required',
            'deposit_description' => 'required',
        ]);




        $coreApiUrl = env('CORE_API_V1') . "/admin/user-balance/increase";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'user_id' => $user->id,
            'currency_id' => $request->deposit_currency,
            'amount' => $request->deposit_amount,
            'description' => $request->deposit_description,
            'tradable' => $request->deposit_tradable == 'on' ? 1 : 0,

        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return redirect()->route('user.show',$user->id)->with('error', $msg);
        }
    }
}
