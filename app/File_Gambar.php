<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File_Gambar extends Model
{
    // use SoftDeletes;
    protected $table = "konten";
    protected $fillable = ['tanggal_post','foto_video_konten', 'caption', 'slug', 'tempat', 'longitude_tempat', 'latitude_tempat', 'id_pengguna', 'id_group'];
    // protected $dates = ['deleted_at'];
}
