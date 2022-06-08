<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wbs extends Model
{
    protected $table = 'wbs';
    protected $primaryKey = 'id_wbs';
    protected $fillable = [
        'id_wbs','id_kegiatan','qty','harga','totalHarga'];

}
