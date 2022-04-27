<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SiteFee;
use App\Models\Currency;
use App\Helpers\JDateHelper;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class SiteFeeController extends Controller
{
    public function index()
    {
        $this->authorize('site-fee-read');

        $data['siteFee'] = [];

        $siteFees = SiteFee::with('currency')->orderBy('date', 'DESC')->take(200)->get();

        $currencyIds = Currency::pluck('id')->toArray();
        foreach ($currencyIds as $currencyId) {
            $siteFee = $siteFees->where('currency_id', $currencyId)->sortByDesc('date')->first();
            if ($siteFee) {
                $data['siteFee'][] = $siteFee;
            }
        }
        // return $results;
        return view('siteFee.all', compact('data'));
    }



    public function indexByCurrency($currencyId, Request $request)
    {
        $this->authorize('site-fee-read');

        $data['sum'] = null;
        $data['siteFee'] = SiteFee::query();

        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $data['siteFee']->where('date', '>=', $startDateTimestamp);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $data['siteFee']->where('date', '<=', $finishDateTimestamp);
        }



        $data['siteFee']->with('currency')->where('currency_id', $currencyId)->orderBy('date', 'desc');

        if ($request->filled('start_at') || $request->filled('finish_at')) {
            $data['siteFee'] = $data['siteFee']->get();

            $data['sum'] = [
                'deposit' => $data['siteFee']->sum('deposit'),
                'deposit_fee' => $data['siteFee']->sum('deposit_fee'),
                'withdraw' => $data['siteFee']->sum('withdraw'),
                'withdraw_fee' => $data['siteFee']->sum('withdraw_fee'),
                'trade' => $data['siteFee']->sum('trade'),
                'trade_fee' => $data['siteFee']->sum('trade_fee'),
                'sum_fee' => $data['siteFee']->sum('sum_fee'),
                'site_transaction_fee' => $data['siteFee']->sum('site_transaction_fee'),
                'day_count' => $data['siteFee']->count()
            ];
        } else {
            $data['siteFee'] = $data['siteFee']->paginate()->appends($request->query());
        }

        $data['currency'] = Currency::find($currencyId);


        $data['siteFeeTotal'] = SiteFee::with('currency')->where('currency_id', $currencyId)->orderBy('date', 'DESC')->first();


        return view('siteFee.indexByCurrency', compact('data'));
    }







    public function refresh()
    {
        $this->authorize('site-fee-read');

        $coreApiUrlWallet = env('CORE_API_V1') . "/admin/site-fee-job";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrlWallet);

        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg);
        }
    }
}
