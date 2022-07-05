<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoDetail extends Model
{
    protected $fillable = ['video_id', 'views', 'subscribes', 'like', 'dont_like'];

    public function video(){
        return $this->belongsTo('App\Models\Video', 'video_id');
    }
}
