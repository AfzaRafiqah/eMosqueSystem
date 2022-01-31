<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['status'] =="Approve")
        {
            return $this->from('mail@example.com')->subject('eMosque Website')->view('email.template_approve')->with('data', $this->data);
        }
        elseif($this->data['status'] =="Decline")
        {
            return $this->from('mail@example.com')->subject('eMosque Website')->view('email.template_decline')->with('data', $this->data);
        }
        
    }
}
