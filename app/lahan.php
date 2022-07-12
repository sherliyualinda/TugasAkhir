<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lahan extends Model
{
    protected $fillable = [
        'id_user', 
        'category_lahan_id', 
        'ukuran',
        'deskripsi',
        'gambar',
        'statusLahan',
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function category(){
        return $this->belongsTo(Category_Lahan::class, 'category_lahan_id');
    }
}
