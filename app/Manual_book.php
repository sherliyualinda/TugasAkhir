<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual_book extends Model
{
    public function category(){
        return $this->belongsTo(CategoryLahan::class, 'id_categoryLahan');
    }
}
