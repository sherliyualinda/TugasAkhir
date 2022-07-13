<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoSubscribe extends Model
{
    protected $fillable = ['id_video', 'id_user'];

    public function video(){
        return $this->belongsTo('App\Models\Video', 'id_video');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
