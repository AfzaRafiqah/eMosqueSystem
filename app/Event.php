<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $table = "events";

    protected $fillable = [
        'userId', 'eventName', 'eventType', 'startDate', 'endDate', 'startTime', 'endTime', 'part', 'numPart', 'minAge', 'maxAge' ,'location', 'status', 'active'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function participates()
    {
        return $this->hasMany(Participate::class, 'eventId');
    }

    
}
