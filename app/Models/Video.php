<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'url', 'id_pengguna'];

    public function pengguna(){
        return $this->belongsTo('App\Pengguna', 'id_pengguna', 'id_pengguna');
    }
}
