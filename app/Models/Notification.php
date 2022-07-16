<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notif';
    protected $primaryKey = 'id_notif';

    protected $fillable = ['id_video','jenis_notif','isi_notif','id_likes','id_comment','id_konten','id_undangan','id_followers','id_anggota','status','is_active','id_user'];
}
