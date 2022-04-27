<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gateway;
use App\Models\Deposits;
use App\Helpers\JDateHelper;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\TableCodeHelper;

class DepositIrtController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('deposit-irt-read');
        $data['gateways'] = Gateway::query();
        $data['users'] = User::query();
        $data['deposits'] = Deposits::query();

        // return $request->all();
        if ($request->filled('code')) {
            $id = TableCodeHelper::code2Id($request->code);
            $data['deposits']->where('id', $id);
        }
        if ($request->filled('id')) {
            $data['deposits']->where('id', $request->id);
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
        if ($request->filled('tracking_code')) {
            $data['deposits']->where('tracking_code', 'LIKE', "%{$request->tracking_code}%");
        }
        if ($request->filled('creation_type')) {
            $data['deposits']->where('creation_type', $request->creation_type);
        }
        if ($request->filled('port_type')) {
            $data['deposits']->where('gateway_id', $request->port_type);
        }
        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $startDateCarbon = Carbon::createFromTimestamp($startDateTimestamp);
            $data['deposits']->where('created_at', '>=', $startDateCarbon);
            // $data['deposits']->where('created_at', '>=', $startDateCarbon)->orWhere('confirmed_by_site_at', '>=', $startDateCarbon);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $finishDateCarbon = Carbon::createFromTimestamp($finishDateTimestamp);
            $data['deposits']->where('created_at', '<=', $finishDateCarbon);
            // $data['deposits']->where('created_at', '<=', $finishDateCarbon)->orWhere('confirmed_by_site_at', '<=', $finishDateCarbon);
        }





        $data['gateways'] = Gateway::all();
        $data['deposits'] = $data['deposits']->with(['user', 'gateway'])->where('type', 1)->latest()->paginate()->appends($request->query());

        return view('depositsIrt.all', compact('data'));
    }
}
