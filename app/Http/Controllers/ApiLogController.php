<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\ApiLog;
use App\Helpers\JDateHelper;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;

class ApiLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin-read');
        $this->authorize('api-log-read');

        $data['apiLog'] = ApiLog::query();

        // return $request->all();
        if ($request->filled('method')) {
            $data['apiLog']->where('method',$request->method);
        }
        if ($request->filled('status')) {
            $data['apiLog']->where('status',$request->status);
        }
        if ($request->filled('causer_id')) {
            $data['apiLog']->where('causer_id',$request->causer_id)->where('causer_type','Admin');
        }
        if ($request->filled('user_id')) {
            $data['apiLog']->where('causer_id',$request->user_id)->where('causer_type','User');
        }
        if ($request->filled('causer_type')) {
            $data['apiLog']->where('causer_type',$request->causer_type);
        }
        if ($request->filled('subject_id')) {
            $data['apiLog']->where('subject_id',$request->subject_id);
        }
        if ($request->filled('action_type')) {
            $data['apiLog']->where('description',$request->action_type);
        }
        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $startDateCarbon = Carbon::createFromTimestamp($startDateTimestamp);
            $data['apiLog']->where('created_at', '>=', $startDateCarbon);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $finishDateCarbon = Carbon::createFromTimestamp($finishDateTimestamp);
            $data['apiLog']->where('created_at', '<=', $finishDateCarbon);
        }
        if ($request->filled('url')) {
            $data['apiLog']->where('url','LIKE',"%$request->url%");
        }
        if ($request->filled('ip')) {
            $data['apiLog']->where('ip',$request->ip);
        }

        $data['apiLog'] = $data['apiLog']->with(['causer'])->latest()->paginate()->appends($request->query());
        $data['admins'] = Admin::all();

        return view('apiLog.all', compact('data'));
    }
}
