<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    public function user(){
    	// return $this->belongsTo('App\Kategori', 'id_kategori');
        return $this->belongsTo('App\User', 'id_pengguna', 'id');
    }
}
