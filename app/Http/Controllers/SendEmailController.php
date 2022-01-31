<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Event;


class SendEmailController extends Controller
{
    function send(Request $request)
    {
        $event = $request->session()->get('event');
        $user = $request->session()->get('user');
        $email = $user->email;

        $status = DB::table('events')
        ->where('id', $event->id)
        ->select('status')
        ->get();

            $currentStatus = DB::table('events')
            ->where('id', $event->id)->first();

        $data = array(

            'name'      =>  $user->name,
            'eventName'      =>  $event->eventName,
            'status' => $currentStatus->status
        );


        Mail::to($email)->send(new SendMail($data));

        return \Redirect::route('events.approve')
            ->with('success', 'Notify via email successfully.');
    }

    function decline(Request $request)
    {

        $event = $request->session()->get('event');
        $user = $request->session()->get('user');
        $email = $user->email;

        $updateStatus = DB::table('events')
            ->where('id', $event->id)
            ->update(['status' => 'Decline']);

        $currentStatus = DB::table('events')
            ->where('id', $event->id)->first();

        $data = array(

            'name'      =>  $user->name,
            'eventName'      =>  $event->eventName,
            'status' => $currentStatus->status
        );


        Mail::to($email)->send(new SendMail($data));

        $events = Event::where('status', '=', 'Decline')
            ->get();

        return redirect()->back()
            ->with('success', 'Event created successfully.');

        // Mail::to($email)->send(new SendMail($data));
        // $events = Event::where('status', '=', 'Decline')
        //     ->get();
        // return view('status.decline', compact('events'));
    }
}
