<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{



    public function index(Request $request)
    {
        $this->authorize('market-read');


        $data['markets'] = Market::with('currency1', 'currency2')->get();


        return view('market.all', compact('data'));
    }




    public function edit($marketId)
    {
        $this->authorize('market-update');


        $data['markets'] = Market::with('currency1', 'currency2')->find($marketId);


        return view('market.edit', compact('data'));
    }





    public function update(Request $request, $marketId)
    {
        $this->authorize('market-update');

        $request->validate([
            'min_order' => 'required',
            'robot_order_amount' => 'required',
            'status' => 'required',
        ]);


        try {
            $market = Market::find($marketId);
            $market->min_order = number_format(str_replace(',', '', $request->min_order), $market->currency2->decimals, '.', '');
            $market->robot_order_amount = number_format(str_replace(',', '', $request->robot_order_amount), $market->currency1->decimals, '.', '');
            $market->status = $request->status;
            $market->save();
        } catch (\Exception $th) {
            dd($th->getMessage());
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }

        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }
}
