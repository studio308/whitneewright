<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'work_id');
    }
}
