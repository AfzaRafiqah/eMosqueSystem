<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    public $table = "committees";

    protected $fillable = [
        'userId' ,'role','admin','assigned_at'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
