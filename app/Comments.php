<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    // use SoftDeletes;
    protected $table = "comment";
    protected $fillable = [
        'deleted_at'
    ];
    // protected $dates = ['deleted_at'];
}
