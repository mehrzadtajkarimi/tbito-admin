<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Ticket;
use App\Helpers\JDateHelper;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\TableCodeHelper;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('ticket-read');
        $data['admins'] = Admin::all();
        $data['ticket'] = Ticket::query();

        if ($request->filled('id')) {
            $data['ticket']->where('id', $request->id);
        }
        if ($request->filled('code')) {
            $id = TableCodeHelper::code2Id($request->code);
            $data['ticket']->where('id', $id);
        }


        if ($request->filled('user')) {
            $keyword = GlobalHelper::exchangeArabicChars($request->user);
            $keyword_array = explode(' ', trim($keyword));
            $data['ticket']->whereHas('user', function ($q) use ($keyword_array) {
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

        if ($request->filled('priority')) {
            $data['ticket']->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $data['ticket']->where('status', $request->status);
        }

        if ($request->filled('admin_id')) {
            $data['ticket']->where('admin_id', $request->admin_id);
        }

        if ($request->filled('start_at')) {
            $startDate = GlobalHelper::convertToEnglish($request->start_at);
            $startDateArr = explode('/', $startDate);
            $startDateTimestamp = JDateHelper::jmktime('0', '0', '0', $startDateArr[1], $startDateArr[2], $startDateArr[0]);
            $startDateCarbon = Carbon::createFromTimestamp($startDateTimestamp);
            $data['ticket']->where('created_at', '>=', $startDateCarbon);
        }

        if ($request->filled('finish_at')) {
            $finishDate = GlobalHelper::convertToEnglish($request->finish_at);
            $finishDateArr = explode('/', $finishDate);
            $finishDateTimestamp = JDateHelper::jmktime('23', '59', '59', $finishDateArr[1], $finishDateArr[2], $finishDateArr[0]);
            $finishDateCarbon = Carbon::createFromTimestamp($finishDateTimestamp);
            $data['ticket']->where('created_at', '<=', $finishDateCarbon);
        }





        $data['ticket'] =  $data['ticket']->with(['user', 'admin'])->whereNull('parent_id')->latest()->paginate();


        return view('ticket.all', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $parentId)
    {
        $this->authorize('ticket-create');

        $request->validate([
            'body' => ['required'],
        ]);

        $adminId = auth('admin')->user()->id;

        $parentTicket = Ticket::find($parentId);
        $parentTicket->status = 4;
        $parentTicket->admin_id = $adminId;
        $parentTicket->updated_at = now();
        $parentTicket->save();

        $ticket = new Ticket();
        $ticket->parent_id = $parentTicket->id;
        $ticket->user_id = $parentTicket->user_id;
        $ticket->body = $request->body;
        $ticket->admin_id = $adminId;
        $ticket->from_admin = 1;
        $ticket->save();

        return back()->with('success', 'عملیات با موفقیت انجام شد');
    }

    public function store(Request $request, $parentId)
    {
        $this->authorize('ticket-create');

        $request->validate([
            'title' => ['required'],
            'body' => ['required'],
        ]);

        $adminId = auth('admin')->user()->id;

        $parentTicket = new Ticket();
        $parentTicket->admin_id = $adminId;
        $parentTicket->from_admin = 1;
        $parentTicket->title = $request->title;
        $parentTicket->priority = 1;
        $parentTicket->user_id = $request->user_id;
        $parentTicket->status = 4;
        $parentTicket->save();

        $ticket = new Ticket();
        $ticket->parent_id = $parentTicket->id;
        $ticket->user_id = $parentTicket->user_id;
        $ticket->body = $request->body;
        $ticket->admin_id = $adminId;
        $ticket->from_admin = 1;
        $ticket->save();

        return back()->with('success', 'عملیات با موفقیت انجام شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('ticket-read');
        $data['ticket'] = Ticket::where('id', $ticket->id)->with(['user', 'admin', 'children'])->first();

        // return $data['ticket'];

        return view('ticket.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('ticket-update');
        $data['ticket'] = Ticket::where('id', $ticket->id)->with(['user', 'admin', 'children'])->first();

        return view('ticket.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('ticket-update');
        $ticket->body = $request->body;
        $ticket->save();
        return redirect()->route("ticket.show", $ticket->parent_id)->with('success', 'عملیات با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('ticket-delete');
        $ticket->delete($ticket);
        return back();
    }
}
