<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    public $table = "participates";

    protected $fillable = [
        'userId', 'eventId', 'name', 'age'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function events()
    {
        return $this->belongsTo(Event::class, 'eventId');
    }
}
