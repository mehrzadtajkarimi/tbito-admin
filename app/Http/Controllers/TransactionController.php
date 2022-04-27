<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function indexByUserCurrency(Request $request, User $user, $currencyId)
    {
        $this->authorize('transaction-read');
        $data['currency'] = Currency::find($currencyId);
        $data['user'] = $user;
        $data['transaction'] = Transaction::where('user_id', $user->id)
            ->where('currency_id', $currencyId)
            ->with(['market', 'currencyFee', 'currency', 'orderUser'])
            ->orderBy('id', 'desc')
            ->paginate()
            ->appends($request->query());
        return view('users.transaction', compact('data'));
    }
}
