<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Helpers\JDateHelper;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin-read');
        $this->authorize('activity-log-read');

        $data['activityLog'] = Activity::query();

        // return $request->all();
        if ($request->filled('subject_id')) {
            $data['activityLog']->where('subject_id',$request->subject_id);
        }
        if ($request->filled('subject_type')) {
            $data['activityLog']->where('subject_type',$request->subject_type);
        }
        if ($request->filled('user_id')) {
            $data['activityLog']->where('causer_id',$request->user_id)->where('causer_type','User');
        }
        if ($request->filled('causer_id')) {
            $data['activityLog']->where('causer_id',$request->causer_id)->where('causer_type','Admin');
        }
        if ($request->filled('action_type')) {
            $data['activityLog']->where('description',$request->action_type);
        }
        if ($request->filled('causer_type')) {
            $data['activityLog']->where('causer_type',$request->causer_type);
        }
        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $startDateCarbon = Carbon::createFromTimestamp($startDateTimestamp);
            $data['activityLog']->where('created_at', '>=', $startDateCarbon);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $finishDateCarbon = Carbon::createFromTimestamp($finishDateTimestamp);
            $data['activityLog']->where('created_at', '<=', $finishDateCarbon);
        }

        $data['activityLog'] = $data['activityLog']->latest()->with('causer')->paginate()->appends($request->query());
        $data['admins'] = Admin::all();

        return view('activityLog.all', compact('data'));
    }
}
