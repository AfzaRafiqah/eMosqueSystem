<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use App\Committee;
use Illuminate\Http\Request;
use Auth;
use DB;
use Alert;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('status', '!=', "Expired")
            ->where('userId', '=', auth()->id())
            ->get();
        //dd($users);//nak cek betul x data yg kita panggil
        return view('events.index', compact('events'));
    }

    public function pendingIndex()
    {


        $role = Committee::with('users')
            ->where('userId', '=', auth()->id())
            ->select('role')
            ->first();

        if ($role->role == 'Imam') {
            $events = Event::where('status', '=', "Pending")
                ->where('active', '=', 1)
                ->where(function ($query) {
                    $query->where('eventType', '=', "Akad Nikah")
                        ->orWhere('eventType', '=', "Tahlil/Doa Selamat");
                })
                ->orderBy('startDate')
                ->orderBy('created_at')
                ->get;
        } elseif ($role->role == 'Pengerusi') {
            $events = Event::where('status', '=', "Pending")
                ->where('active', '=', 1)
                ->where(function ($query) {
                    $query->where('eventType', '!=', "Akad Nikah")
                        ->where('eventType', '!=', "Tahlil/Doa Selamat");
                })
                ->orderBy('startDate')
                ->orderBy('created_at')
                ->get();
        } else {
            $events = Event::where('status', '=', "Pending")
                ->where('active', '=', 1)
                ->orderBy('startDate', 'ASC')
                ->orderBy('created_at', 'ASC')
                ->get();
        }

        //dd($events);//nak cek betul x data yg kita panggil
        return view('events.pending', compact('events'));
    }

    public function approveIndex()
    {

        $events = Event::where('status', '=', "Approve")
            ->orderBy('startDate')
            ->orderBy('startTime')
            ->get();

        //dd($events);//nak cek betul x data yg kita panggil
        return view('events.approve', compact('events'));
    }

    public function upcoming()
    {
        $events = Event::whereBetween('startDate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('status', '=', 'Approve')
            ->orderBy('startDate')
            ->orderBy('startTime')
            ->get();
        //dd($events);//nak cek betul x data yg kita panggil
        return view('events.index', compact('events'));
    }

    public function myEvent()
    {
        $events = Event::where('userId', '=', auth()->id())
            ->get();
        //dd($events);//nak cek betul x data yg kita panggil
        return view('events.myEvent', compact('events'));
    }

    public function eventAdmin()
    {
        $userId = Auth::user()->id;

        $admin = Committee::where('userId', '=', auth()->id())->first();
        dd($admin);
        //if(A)
        $events = Event::where('status', '==', "Pending")
            ->get();
        //dd($users);//nak cek betul x data yg kita panggil
        return view('events.index', compact('events'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(auth()->user()->committee);
        if (auth()->user()->committee == 1) {
            return view('events.createCom');
        } else {
            return view('events.create');
        }
    }

    public function createAdmin()
    {

        return view('events.createAdmin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->eventType != "Kem") {
            $endDate = $request->startDate;
        } else {
            $endDate = $request->endDate;
        }

        Event::create([
            'userId' => Auth::user()->id,
            'eventName' => $request->eventName,
            'eventType' => $request->eventType,
            'startDate' => $request->startDate,
            'endDate' => $endDate,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'location' => $request->location,
            'part' => $request->part,
            'numPart' => $request->numPart,
            'status' => $request->status,
            'active' => $request->active,
            'minAge' => $request->minAge,
            'maxAge' => $request->maxAge,

        ]);
        return redirect()->route('myEvent.index') //myevent admin
            ->with('success', 'Event Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $user = User::where('id', $event->userId)->first();
        return view('events.show', compact('event', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        if ($request->eventType != "Kem") {

            $endDate = $request->startDate;


            //if($request->part == "")
            DB::table('events')
                ->where('id', '=', $request->id)
                ->update([
                    'eventName' => $request->eventName,
                    'startDate' => $request->startDate,
                    'endDate' => $endDate,
                    'startTime' => $request->startTime,
                    'endTime' => $request->endTime,
                    'location' => $request->location,
                    'part' => $request->part,
                    'numPart' => $request->numPart,
                    'minAge' => $request->minAge,
                    'maxAge' => $request->maxAge,
                ]);

            return redirect()->route('events.index')
                ->with('success', 'Event updated successfully');
        } else {

            //dd($request->endDate);
            $event->update($request->all());

            return redirect()->route('events.index')
                ->with('success', 'Event updated successfully');
        }
    }



    public function cancelEvent(Event $event)
    {

        $updateStatus = DB::table('events')
            ->where('id', $event->id)
            ->update(['status' => 'Cancel']);

        return redirect()->route('events.index')
            ->with('warning', 'Booking Canceled ');
    }

    //myBooking
    public function myBookingIndex()
    {
        $events = Event::with('users')
            ->where('userId', Auth::user()->id)
            ->get();

        if (auth()->user()->committee == 1) {
            return view('myBookings.indexCom', compact('events'));
        } else {
            return view('myBookings.index', compact('events'));
        }
    }

    //myBookingAdd
    public function myBookingCreate()
    {

        return view('myBookings.create');
    }

    public function myBookingStore(Request $request)
    {
        if ($request->eventType != "Kem") {
            $endDate = $request->startDate;
        } else {
            $endDate = $request->endDate;
        }

        Event::create([
            'userId' => Auth::user()->id,
            'eventName' => $request->eventName,
            'eventType' => $request->eventType,
            'startDate' => $request->startDate,
            'endDate' => $endDate,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'location' => $request->location,
            'part' => $request->part,
            'numPart' => $request->numPart,
            'status' => $request->status,
            'active' => $request->active,
            'minAge' => $request->minAge,

        ]);

        return redirect()->route('myBookings.index')
            ->with('success', 'Event Created Successfully!');
    }

    public function myBookingShow(Event $event)
    {
        $user = User::where('id', $event->userId)->first();

        if (auth()->user()->committee == 1) {
            return view('events.showCom', compact('event', 'user'));
        } else {
            return view('myBookings.show', compact('event', 'user'));
        }
    }

    public function myBookingCancel(Event $event)
    {

        $updateStatus = DB::table('events')
            ->where('id', $event->id)
            ->update([
                'status' => 'Cancel',
                'active' => 0
            ]);

        return redirect()->route('myBookings.index')
            ->with('warning', 'Booking Canceled ');
    }

    public function myBookingUpdate(Request $request, Event $event)
    {
        $request->validate([
            'eventName' => 'required',
        ]);

        $event->update($request->all());

        return redirect()->route('myBookings.index')
            ->with('success', 'Booking updated successfully');
    }

    //myBookingEdit
    public function myBookingEdit(Event $event)
    {
        return view('myBookings.edit', compact('event'));
    }

    //USER EVENT
    public function uEventIndex()
    {
        $events = Event::where('part', '!=', 'Committee Member')
            ->where('status', '=', 'approve')
            ->get();
        //dd($users);//nak cek betul x data yg kita panggil
        return view('uEvents.index', compact('events'));
    }

    public function uEventShow(Event $event)
    {
        $user = User::where('id', $event->userId)->first();

        return view('uEvents.show', compact('event', 'user'));
    }

    public function cBcommittee()
    {
        $events = DB::table('events')
            ->where('status', '=', 'Approve')
            ->where('active', '=', 1)
            ->orderBy('startDate', 'ASC')
            ->get();

        //dd($admin);

        return view('events.committee', compact('events'));
    }

    public function cBuser()
    {
        $events = DB::table('users')
            ->join('events', 'users.id', '=', 'events.userId')
            ->where('status', '!=', 'Expired')
            ->where('committee', '=', '0')
            ->get();
        return view('events.user', compact('events'));
    }

    public function emailDecline(Event $event)
    {
        $userId = $event->userId;
        $updateStatus = DB::table('events')
            ->where('id', $event->id)
            ->update([
                'status' => 'Decline',
                'active' => 0
            ]);

        $user = User::where('id', '=', $event->userId)->first();
        return redirect()
            ->route('send.email', [$event, $user])
            ->with('event', $event)
            ->with('user', $user);
    }

    public function approved()
    {
        $events = Event::where('status', '=', 'approve')
            ->get();
        return view('status.approved', compact('events'));
    }

    public function emailApprove(Event $event)
    {

        //retrieve number of event in database
        $countEvent = Event::where('status', '=', 'Approve')->count();

        //nak check availability
        if ($event->eventType != "Kem") {
            $endDate = $event->startDate;
        } else {
            $endDate = $event->endDate;
        }

        $sDate = $event->startDate;
        $eDate = $endDate;
        $sTime = $event->startTime;
        $eTime = $event->endTime;
        $eventId = $event->id;

        $checkDate = DB::table('events')
            ->orWhere(function ($query) use ($sDate, $event) {

                $query->where('startDate', '<', $sDate)
                    ->where('endDate', '<', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->orWhere(function ($query) use ($event, $eDate) {

                $query->where('startDate', '>', $eDate)
                    ->where('endDate', '>', $eDate)
                    ->where('status', '=', 'Approve');
            })
            ->count(); //kira yg overlap. If total count same with approve event, not overlap

        $countEventT = Event::where('status', '=', 'Approve')
            ->where('eventType', '!=', "Kem")
            ->where('startDate', '=', $sDate)
            ->count();

        $checkTime = DB::table('events')
            ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {
                $query->where('startTime', '<', $sTime)
                    ->where('endTime', '<', $sTime)
                    ->where('eventType', '!=', "Kem")
                    ->where('startDate', '=', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                $query->where('startTime', '>', $eTime)
                    ->where('endTime', '>', $eTime)
                    ->where('eventType', '!=', "Kem")
                    ->where('startDate', '=', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->count();



        if ($checkDate != $countEvent) {
            if ($event->eventType != "Kem") {

                if ($checkTime != $countEventT) {

                    $overlap = DB::table('events')
                        ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {
                            $query->where('startTime', '<', $sTime)
                                ->where('endTime', '>', $eTime)
                                ->where('eventType', '!=', "Kem")
                                ->where('startDate', '=', $sDate)
                                ->where('status', '=', 'Approve');
                        })
                        ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                            $query->where('startTime', '>', $sTime)
                                ->where('endTime', '<', $eTime)
                                ->where('eventType', '!=', "Kem")
                                ->where('startDate', '=', $sDate)
                                ->where('status', '=', 'Approve');
                        })
                        ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                            $query->where('endTime', '>', $sTime)
                                ->where('endTime', '<', $eTime)
                                ->where('eventType', '!=', "Kem")
                                ->where('startDate', '=', $sDate)
                                ->where('status', '=', 'Approve');
                        })
                        ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                            $query->where('startTime', '=', $sTime)
                                ->where('endTime', '=', $eTime)
                                ->where('eventType', '!=', "Kem")
                                ->where('startDate', '=', $sDate)
                                ->where('status', '=', 'Approve');
                        })
                        ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                            $query->where('startTime', '>', $sTime)
                                ->where('endTime', '<', $eTime)
                                ->where('eventType', '!=', "Kem")
                                ->where('startDate', '=', $sDate)
                                ->where('status', '=', 'Approve');
                        })
                        ->get();

                    return view('events.overlap', compact('overlap', 'eventId'))
                        ->with('warning', 'There is an event going on at that time');
                } else {

                    $updateStatus = DB::table('events')
                        ->where('id', $event->id)
                        ->update(['status' => 'Approve']);

                    $user = User::where('id', '=', $event->userId)->first();
                    return redirect()
                        ->route('send.email', [$event, $user])
                        ->with('event', $event)
                        ->with('user', $user);
                }
            } else {

                $overlap = DB::table('events')
                    ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $eDate) {
                        $query->where('startDate', '<', $sDate)
                            ->where('endDate', '>', $eDate)
                            ->where('status', '=', 'Approve');
                    })
                    ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $eDate) {

                        $query->where('startDate', '>', $sDate)
                            ->where('endDate', '<', $eDate)
                            ->where('status', '=', 'Approve');
                    })
                    ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $eDate) {

                        $query->where('endDate', '>', $sDate)
                            ->where('endDate', '<', $eDate)
                            ->where('status', '=', 'Approve');
                    })
                    ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $eDate) {

                        $query->where('startDate', '=', $sDate)
                            ->where('endDate', '=', $eDate)
                            ->where('status', '=', 'Approve');
                    })
                    ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $eDate) {

                        $query->where('startDate', '>', $sDate)
                            ->where('endDate', '<', $eDate)
                            ->where('eventType', '=', "Kem")
                            ->where('status', '=', 'Approve');
                    })
                    ->get();

                return view('events.overlap', compact('overlap', 'eventId'))
                    ->with('warning', 'There is an event going on at that time');
            }
        } else {

            $updateStatus = DB::table('events')
                ->where('id', $event->id)
                ->update(['status' => 'Approve']);

            $user = User::where('id', '=', $event->userId)->first();
            return redirect()
                ->route('send.email', [$event, $user])
                ->with('event', $event)
                ->with('user', $user);
        }



        // $userId = $event->userId;
        // $updateStatus = DB::table('events')
        //     ->where('id', $event->id)
        //     ->update(['status' => 'Approve']);

        // $user = User::where('id', '=', $event->userId)->first();
        // return redirect()
        //     ->route('send.email', [$event, $user])
        //     ->with('event', $event)
        //     ->with('user', $user);
    }

    public function overlapList()
    {
        $overlap = DB::table('events')
            ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {
                $query->where('startTime', '<', $sTime)
                    ->where('endTime', '>', $eTime)
                    ->where('eventType', '!=', "Kem")
                    ->where('startDate', '=', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                $query->where('startTime', '>', $sTime)
                    ->where('endTime', '<', $eTime)
                    ->where('eventType', '!=', "Kem")
                    ->where('startDate', '=', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                $query->where('endTime', '>', $sTime)
                    ->where('endTime', '<', $eTime)
                    ->where('eventType', '!=', "Kem")
                    ->where('startDate', '=', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                $query->where('startTime', '=', $sTime)
                    ->where('endTime', '=', $eTime)
                    ->where('eventType', '!=', "Kem")
                    ->where('startDate', '=', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->orWhere(function ($query) use ($sTime, $eTime, $sDate, $event) {

                $query->where('startTime', '>', $sTime)
                    ->where('endTime', '<', $eTime)
                    ->where('eventType', '!=', "Kem")
                    ->where('startDate', '=', $sDate)
                    ->where('status', '=', 'Approve');
            })
            ->get();
        //dd($users);//nak cek betul x data yg kita panggil
        return view('events.overlap', compact('overlap'));
    }

    public function approveAnyway(Event $event)
    {

        $updateStatus = DB::table('events')
            ->where('id', $event->id)
            ->update(['status' => 'Approve']);

        $user = User::where('id', '=', $event->userId)->first();
        return redirect()
            ->route('send.email', [$event, $user])
            ->with('event', $event)
            ->with('user', $user);
    }



    public function cancel()
    {
        $events = Event::where('status', '=', 'cancel')
            ->get();
        return view('status.cancel', compact('events'));
    }

    public function upcomingEventUser()
    {
        $events = Event::whereBetween('startDate', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        //dd($users);//nak cek betul x data yg kita panggil
        return view('uEvents.upcoming event', compact('events'));
    }



    public function changeActive(Event $event)
    {
        if ($event->active == 1) {
            DB::table('events')
                ->where('id', $event->id)
                ->update(['active' => 0]);

            return redirect()->route('myBookings.index')
                ->with('warning', 'Booking Deactivated ');
        } else {
            DB::table('events')
                ->where('id', $event->id)
                ->update(['active' => 1]);

            return redirect()->route('myBookings.index')
                ->with('success', 'Booking Activated ');
        }
    }

    public function findForm(Event $event)
    {
        return view('events.findForm');
    }

    public function getRecord(Request $request)
    {
        if($request->status == 'All')
        {
            $events = Event::with('users')
            ->whereBetween('startDate', [$request->start_date, $request->end_date])
            ->orderBy('startDate', 'ASC')
            ->get();
        }else{
            $events = Event::with('users')
            ->whereBetween('startDate', [$request->start_date, $request->end_date])
            ->where('status','=', $request->status)
            ->orderBy('startDate', 'ASC')
            ->get();
        }
        

        $start = $request->start_date;
        $end = $request->end_date;

        //dd($event);
        return view('events.result', compact('events', 'users', 'start', 'end'));
    }
}
