<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Helpers\TableCodeHelper;
use App\Models\Currency;
use App\Models\WalletAddress;
use Illuminate\Http\Request;

class WalletAddressController extends Controller
{
    public function index()
    {
        $this->authorize('wallet-address-read');

        $data['currency'] =  Currency::where('id', '!=', 1)->where('has_networks', 0)->get();
        $data['walletAddresses'] = WalletAddress::all();
        $data['count'] = null;

        foreach ($data['currency'] as $currency) {
            $walletAddresses = $data['walletAddresses']->where('currency_id', $currency->id);
            $data['count'][$currency->id] = [
                'free' => $walletAddresses->where('used', 0)->count(),
                'all' => $walletAddresses->count()
            ];
        }

        return view('walletAddress.all', compact('data'));
    }

    public function check($walletId)
    {
        $this->authorize('wallet-address-check');

        return $walletId;

        $data['currency'] =  Currency::all();


        return view('walletAddress.create', compact('data'));
    }


    public function create(Request $request, $currencyId)
    {
        $this->authorize('wallet-address-create');

        $data['currency'] =  Currency::find($currencyId);
        $data['walletAddress'] =  WalletAddress::with(['user']);

        if ($request->filled('user')) {

            $keyword = GlobalHelper::exchangeArabicChars($request->user);
            $keyword_array = explode(' ', trim($keyword));

            $data['walletAddress']->whereHas('user', function ($q) use ($keyword_array) {
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
        if ($request->filled('address')) {
            $data['walletAddress']->where('address', 'LIKE', "%{$request->address}%");
        }
        if ($request->has('used')) {
            $data['walletAddress']->where('used', $request->used);
        }


        $data['walletAddress'] = $data['walletAddress']->paginate()->appends($request->query());


        return view('walletAddress.create', compact('data'));
    }


    public function insert($currencyId)
    {
        $this->authorize('wallet-address-create');

        return $currencyId;
    }


    public function hash($currencyId)
    {
        $this->authorize('wallet-address-check');

        return 'hash';
    }

    public function file($currencyId)
    {
        $this->authorize('wallet-address-check');

        return 'file';
    }
}
