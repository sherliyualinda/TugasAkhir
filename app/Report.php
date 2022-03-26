<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    // use SoftDeletes;
    protected $table = "reports";
    protected $fillable = [
        'kategori_report', 'account_reporter', 'alasan_report', 'id_konten_reported', 'id_comment_reported', 'status', 'deleted_at'
    ];
    // protected $dates = ['deleted_at'];
}
