<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    protected $fillable = ['id_video', 'ip_address', 'user_agent','id_user'];

    public function video(){
        return $this->belongsTo('App\Models\Video', 'id_video');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }
}
