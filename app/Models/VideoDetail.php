<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoDetail extends Model
{
    protected $fillable = ['id_video', 'views', 'subscribes', 'like', 'dont_like','id_user','comment'];

    public function video(){
        return $this->belongsTo('App\Models\Video', 'id_video');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
