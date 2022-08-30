<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
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

    public function pengguna(){
        return $this->belongsTo(Pengguna::class, 'id_user');
    }

    public function category(){
        return $this->belongsTo(CategoryLahan::class, 'category_lahan_id');
    }
}
