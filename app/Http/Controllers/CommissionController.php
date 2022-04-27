<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{


    public function index()
    {
        $this->authorize('commission-read');
        $data['commissions'] = Commission::all();

        return view('commission.all', compact('data'));
    }




    public function edit($commissionId)
    {
        $this->authorize('commission-update');

        $data['commission'] = Commission::find($commissionId);

        return view('commission.edit', compact('data'));
    }



    public function update(Request $request, $commissionId)
    {
        $this->authorize('commission-update');

        $request->validate([
            'min_monthly_total_trades_irt' => 'required',
            'max_monthly_total_trades_irt' => 'required',
            'percent' => 'required',
        ]);


        try {
            $commission = Commission::find($commissionId);
            $commission->min_monthly_total_trades_irt = str_replace(',', '', $request->min_monthly_total_trades_irt);
            $commission->max_monthly_total_trades_irt = $request->has('infinity') ? NULL : str_replace(',', '', $request->max_monthly_total_trades_irt);
            $commission->percent = $request->percent;
            $commission->save();
        } catch (\Exception $th) {
            dd($th);
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }

        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }
}
