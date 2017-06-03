<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';

    protected $fillable = [
        'title',
        'work_id',
        'path',
        'primary'
    ];

    public function works()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }
}
