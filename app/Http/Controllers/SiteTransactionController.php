<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\SiteTransaction;
use App\Models\SiteWallet;

class SiteTransactionController extends Controller
{
    public function indexByCurrency($currencyId)
    {
        $data['site_transactions'] = $siteTransactions = SiteTransaction::where('currency_id', $currencyId)->with(['currency'])->orderBy('id', 'desc')->paginate();
        $data['currency'] = Currency::find($currencyId);
        return view('siteTransaction.all', compact('data'));
    }





    public function create()
    {
        $this->authorize('site-transaction-read');
        $data['currencies'] = Currency::get();
        return view('siteTransaction.create', compact('data'));
    }





    public function store(Request $request)
    {
        $this->authorize('site-transaction-create');

        $this->validate($request, [
            'type' => ['required'],
            'currency_id' => ['required'],
            'amount' => ['required'],
            'description' => ['required'],

        ]);

        try {
            $lastSiteTransaction = SiteTransaction::where("currency_id", $request->currency_id)->orderBy('id', 'desc')->first();
            $lastBalance = $lastSiteTransaction ? $lastSiteTransaction->balance : 0;

            $siteTransaction = new SiteTransaction();
            $siteTransaction->currency_id = $request->currency_id;
            $siteTransaction->sign = ($request->type == "deposit") ? 1 : -1;
            $siteTransaction->amount = str_replace(',', '', $request->amount);
            $siteTransaction->fee = $request->fee ? str_replace(',', '', $request->fee) : 0;
            $siteTransaction->description = $request->description;
            $siteTransaction->balance = $lastBalance + ($siteTransaction->sign * $siteTransaction->amount);
            $siteTransaction->date = time();
            $siteTransaction->save();

            $siteWallet = SiteWallet::where('currency_id', $request->currency_id)->first();
            if (!$siteWallet) {
                $siteWallet = new SiteWallet();
            }
            $siteWallet->currency_id = $request->currency_id;
            $siteWallet->amount = $siteTransaction->balance;
            $siteWallet->save();
        } catch (\Exception $th) {
            dd($th->getMessage());
            return back()->with('error', 'خطایی در انجام عملیات رخ داده است.');
        }
        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }






    public function destroy($siteTransactionId)
    {
        $this->authorize('site-transaction-delete');
        $siteTransaction = SiteTransaction::find($siteTransactionId);
        $siteTransaction->delete();
        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }
}
