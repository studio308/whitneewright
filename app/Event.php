<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_at',
        'end_at',
        'start_time',
        'end_time',
        'path',
        'alias'
    ];

    protected $table = 'events';
}
