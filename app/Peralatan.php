<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $table = 'peralatans';
    protected $primaryKey = 'id_peralatan';

    public function pengguna(){
        return $this->belongsTo('App\Pengguna', 'id_pemilik', 'id_pengguna');
    }
}
