<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'url', 'id_pengguna'];

    public function user(){
        return $this->belongsTo('App\User', 'id_pengguna');
    }
    
    public function detail(){
        return $this->hasOne('App\Models\VideoDetail', 'id_video', 'id');
    }
}
