<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Event;
use App\Committee;
use App\Models\Reminder;
use App\Mail\ReminderEmailDigest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Notifications\EventReminderNotification;
use Illuminate\Support\Facades\Notification;


class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to committee about the event';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $times = [
            Carbon::now()->format('Y-m-d'),
            Carbon::now()->addDays(3)->format('Y-m-d')
        ];

        //Get all reminder for today
        $events = Event::with('users')
        ->where('startDate','=', Carbon::now()->addDays(3)->format('Y-m-d') )
        ->orderBy('startDate')
        ->get();
        //dd($events);
        $committees = User::where('committee',1)
        ->get();


        foreach($events as $event){
            foreach($committees as $com)
            {
                Mail::to($com->email)->send(new ReminderEmailDigest($event));
            }
        }
        

        //$this ->info("Event reminders of ",$events->count() . "events has been sent succesfully");
    }

}
