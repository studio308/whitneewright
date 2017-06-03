<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'price',
        'measurements',
        'alias'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'work_id');
    }

    public function primaryMedia()
    {
        return $this->medias->where('primary', 1)->pluck('path')->first();
    }

    public function getMedias()
    {
        return $this->medias;
    }

    public function otherMedia()
    {
        return $this->medias->where('primary',0)->all();
    }
}
