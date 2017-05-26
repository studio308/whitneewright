<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'alias'
    ];

    public function works()
    {
        return $this->hasMany(Work::class, 'category_id');
    }
}
