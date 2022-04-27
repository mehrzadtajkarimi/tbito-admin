<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\SiteWallet;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ReportWalletController extends Controller
{

    public function index()
    {
        $this->authorize('report-wallet-read');


        $data['currencies'] = Currency::get();
        $userExcludedBalanceIds = User::where('exclude_balance', 1)->pluck('id')->toArray();
        $siteWallets = SiteWallet::get();

        $data['result'] = [];
        foreach ($data['currencies'] as $currency) {
            $data['result'][$currency->id]['title'] = $currency->title;
            $data['result'][$currency->id]['id'] = $currency->id;
            $data['result'][$currency->id]['decimals'] = $currency->decimals;

            # calc user balances
            $userBalances = Wallet::where('currency_id', $currency->id)->whereNotIn('user_id', $userExcludedBalanceIds)->sum('amount');
            $data['result'][$currency->id]['user_balances'] = $userBalances;

            # calc external wallet
            $siteWallet = $siteWallets->where('currency_id', $currency->id)->first();
            $siteWalletAmount = $siteWallet ? $siteWallet->amount : 0;
            $data['result'][$currency->id]['external_wallets'] =  $siteWalletAmount;

            #
            $data['result'][$currency->id]['internal_wallets'] = $userBalances - $siteWalletAmount;
        }

        return view('reportWallet.all', compact('data'));
    }



    public function show($currencyId)
    {
        $this->authorize('report-wallet-user-balance');

        $userExcludedBalanceIds = User::where('exclude_balance', 1)->pluck('id')->toArray();

        $data['currency'] = Currency::find($currencyId);

        $data['results'] = Wallet::where('currency_id', $currencyId)->whereNotIn('user_id', $userExcludedBalanceIds)->where('amount', '!=', 0)->with(['user', 'currency'])->orderBy('amount', 'desc')->paginate();

        return view('reportWallet.show', compact('data'));
    }
}
