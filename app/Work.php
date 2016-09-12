<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public function categories()
    {
        $this->belongsTo(Category::class);
    }
}
