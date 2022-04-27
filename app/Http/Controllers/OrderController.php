<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Trade;
use App\Models\Market;
use App\Models\Currency;
use App\Helpers\JDateHelper;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\DateTimeHelper;
use App\Helpers\TableCodeHelper;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        // return $request->all();

        $data['orders'] = Order::query();


        if ($request->filled('code')) {
            $id = TableCodeHelper::code2Id($request->code);
            $data['orders']->where('id', $id);
        }
        if ($request->filled('id')) {
            $data['orders']->where('id', $request->id);
        }
        if ($request->filled('side')) {
            $data['orders']->where('side', $request->side);
        }
        if ($request->filled('market')) {
            $data['orders']->where('market_id', $request->market);
        }
        if ($request->filled('user')) {

            $keyword = GlobalHelper::exchangeArabicChars($request->user);
            $keyword_array = explode(' ', trim($keyword));

            $data['orders']->whereHas('user', function ($q) use ($keyword_array) {
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
        if ($request->filled('fee')) {
            $data['orders']->where('currency_fee_id', $request->fee);
        }
        if ($request->filled('status')) {
            $data['orders']->where('status', $request->status);
        }

        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $startDateCarbon = Carbon::createFromTimestamp($startDateTimestamp);
            $data['orders']->where('created_at', '>=', $startDateCarbon);
            // $data['deposits']->where('created_at', '>=', $startDateCarbon)->orWhere('confirmed_by_site_at', '>=', $startDateCarbon);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $finishDateCarbon = Carbon::createFromTimestamp($finishDateTimestamp);
            $data['orders']->where('created_at', '<=', $finishDateCarbon);
            // $data['deposits']->where('created_at', '<=', $finishDateCarbon)->orWhere('confirmed_by_site_at', '<=', $finishDateCarbon);
        }

        if (!$request->has('is_robot')) {
            $data['orders']->where('is_robot', 0);
        }


        $data['orders'] = $data['orders']->with(['market', 'currency1', 'currency2', 'currencyFee', 'user'])
            ->latest()
            ->paginate()
            ->appends($request->query());


        $data['markets'] = Market::all();
        $data['currencies'] = Currency::all();

        return view('order.all', compact('data'));
    }



    public function trades($orderId)
    {
        $items = Trade::where('buyer_order_id', $orderId)
            ->orWhere('seller_order_id', $orderId)
            ->orderBy('id')
            ->with(['buyer', 'seller', 'currency1', 'currency2'])
            ->get();




        $response = [];
        foreach ($items as $item) {
            $response[] = [

                'amount' =>  number_format($item->amount, $item->currency1->decimals),
                'price' => number_format($item->price, $item->currency2->decimals),
                'created_at' =>  DateTimeHelper::getDateTime($item->created_at->timestamp),
                'user_buyer' => $item->buyer->firstname . ' ' . $item->buyer->lastname,
                'user_buyer_profile' => route('user.show', $item->buyer->id),
                'user_seller' => $item->seller->firstname . ' ' . $item->seller->lastname,
                'user_seller_profile' =>  route('user.show', $item->seller->id),
            ];
        }
        return $response;
    }
}
