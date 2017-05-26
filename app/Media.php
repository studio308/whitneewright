<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';

    public function works()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }
}
