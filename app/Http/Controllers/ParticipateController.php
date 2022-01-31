<?php

namespace App\Http\Controllers;

use App\Participate;
use App\Event;
use App\Committee;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class ParticipateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('users')
            ->where('part', '=', 'Others')
            ->where('status','!=','Cancel')
            ->where('status','!=','Pending')
            ->where('status','!=','Expired')
            ->where('status','!=','Decline')
            ->get();

        $admin = Committee::with('users')
            ->where('admin', '=', 1)
            ->where('userId', '=', auth()->id())
            ->count();

        if ($admin != NULL) {
            return view('participates.index', compact('events'));
        } else {
            return view('participates.indexCom', compact('events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $event = $request->event;

        $admin = Committee::with('users')
            ->where('admin', '=', 1)
            ->where('userId', '=', auth()->id())
            ->count();


        if ($admin != NULL) {
            return view('participates.createByAdmin', compact('event'));
        } elseif (auth()->user()->committee == 1) {
            return view('participates.create', compact('event'));
        } else {
            return view('participates.createByUser', compact('event'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function myself(Event $event)
    {

        $dateOfBirth = auth()->user()->dOfBirth;
        $age = Carbon::parse($dateOfBirth)->age;

        $events = Event::withCount('participates')->findOrFail($event->id);

        if ($event->numPart <= $events->participates_count) {
            //dd("dah penuh");
            return redirect()->back()
                ->with('danger', 'The number of participant already achieved it limits.');
        }

        if ($events->maxAge != 0) {

            if ($age >= $events->minAge && $age <= $events->maxAge) {

                // dd("umur cukup");

                $check = DB::table('participates')
                    ->where('name', '=', Auth::user()->name)
                    ->where('userId', '=', Auth::user()->id)
                    ->where('eventId', $event->id)
                    ->count();

                //dd($check);
                if ($check != NULL) {
                    return redirect()->route('participates.myPartIndex')
                        ->with('danger', 'You have already registered.');
                } else {

                    Participate::create([
                        'userId' => Auth::user()->id,
                        'eventId' => $event->id,
                        'name' => Auth::user()->name,
                        'age' => $age
                    ]);
                    return redirect()->back()
                        ->with('success', 'Your registration was successfully.');
                }
            } elseif ($age <= $events->minAge) {
                //dd("umur x cukup");
                return redirect()->back()
                    ->with('danger', 'Age does NOT REACH the minimum age.');
            } else {
                //dd("umur lebih ");
                return redirect()->back()
                    ->with('danger', 'Age EXCEEDS the maximum age.');
            }
        } elseif ($age >= $events->minAge) {

            $check = DB::table('participates')
                ->where('name', '=', Auth::user()->name)
                ->where('userId', '=', Auth::user()->id)
                ->where('eventId', $event->id)
                ->count();

            //dd($check);
            if ($check != NULL) {
                return redirect()->back()
                    ->with('danger', 'You have already registered.');
            } else {

                Participate::create([
                    'userId' => Auth::user()->id,
                    'eventId' => $event->id,
                    'name' => Auth::user()->name,
                    'age' => $age
                ]);
                return redirect()->back()
                    ->with('success', 'Your registration was successfully.');
            }
        } else {
            return redirect()->back()
                ->with('warning', 'Your age does NOT REACH the minimum age');
        }
    }

    public function store(Request $request)
    {

        $events = Event::withCount('participates')->findOrFail($request->eventId);

        if ($events->numPart <= $events->participates_count) {
            //dd("dah penuh");
            return redirect()->back()
                ->with('danger', 'The number of participant already achieved it limits.');
        }

        if ($events->maxAge != 0) {

            if ($request->age >= $events->minAge && $request->age <= $events->maxAge) {

                    Participate::create([
                        'userId' => Auth::user()->id,
                        'eventId' =>  $request->eventId,
                        'name' => $request->name,
                        'age' => $request->age
                    ]);
                    return redirect()->back()
                        ->with('success', 'Your registration was successfully.');
                
            } elseif ($request->age <= $events->minAge) {
                //dd("umur x cukup");
                return redirect()->back()
                    ->with('danger', 'Age does NOT REACH the minimum age.');
            } else {
                //dd("umur lebih ");
                return redirect()->back()
                    ->with('danger', 'Age EXCEEDS the maximum age.');
            }
        } elseif ($request->age >= $events->minAge) {

                Participate::create([
                    'userId' => Auth::user()->id,
                    'eventId' =>  $request->eventId,
                    'name' => $request->name,
                    'age' => $request->age
                ]);
                return redirect()->back()
                    ->with('success', 'Your registration was successfully.');
            
        } else {
            return redirect()->back()
                ->with('warning', 'Your age does NOT REACH the minimum age');
        }




        //dd($events);
        // if ($request->age < $events->minAge) {

        //     return redirect()->back()
        //         ->with('success', 'Your registration was successfully.');
        // }

        // if ($events->numPart <= $events->participates_count) {

        //     return redirect()->back()
        //         ->with('warning', 'The number of participant already achieved it limits.');
        // }

        // Participate::create([
        //     'userId' => Auth::user()->id,
        //     'eventId' => $request->eventId,
        //     'name' => $request->name,
        //     'age' => $request->age
        // ]);

        // return redirect()->back()->with('success', 'Apply created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participate  $participate
     * @return \Illuminate\Http\Response
     */
    public function show(Participate $participate)
    {
        $admin = Committee::with('users')
            ->where('admin', '=', 1)
            ->where('userId', '=', auth()->id())
            ->count();

        if ($admin != NULL) {
            return view('participates.show', compact('participate'));
        } else {
            return view('participates.showCom', compact('participate'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participate  $participate
     * @return \Illuminate\Http\Response
     */
    public function edit(Participate $participate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participate  $participate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participate $participate)
    {
        //
    }


    public function listIndex(Event $event)
    {
        $id = $event->id;

        $participates = Participate::with('users', 'events')
            ->where('eventId', '=', $event->id)
            ->get();

        $ikah = Event::where('id', '=', $event->id)
            ->get();

        $admin = Committee::with('users')
            ->where('admin', '=', 1)
            ->where('userId', '=', auth()->id())
            ->count();

        if ($admin != NULL) {
            return view('participates.list', compact('participates', 'users', 'events', 'event'));
        } else {
            return view('participates.listCom', compact('participates', 'users', 'events', 'event'));
        }
    }

    public function manage(Event $event)
    {
        $id = $event->id;

        $participates = Participate::with('users', 'events')
            ->where('eventId', '=', $event->id)
            ->get();

        $ikah = Event::where('id', '=', $event->id)
            ->get();

        return view('participates.manage', compact('participates', 'users', 'events', 'event'));
    }

    public function myPartIndex()
    {

        $participates = Participate::with('users', 'events')
            ->where('userId', Auth::user()->id)
            ->get();

        $admin = Committee::with('users')
            ->where('admin', '=', 1)
            ->where('userId', '=', auth()->id())
            ->count();


        if ($admin != NULL) {
            return view('participates.myPartAdmin', compact('participates', 'events'));
        } elseif (auth()->user()->committee == 1) {
            return view('participates.myPartCom', compact('participates', 'events'));
        } else {
            return view('participates.myPartIndex', compact('participates', 'events'));
        }
    }

    public function destroy(Participate $participate)
    {
        $participate->delete();

        return redirect()->back()
            ->with('danger', 'Participation has been canceled');
    }

    public function cuba($organization_id)
    {
        dd($organization_id);
    }
}
