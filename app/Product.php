<?php

namespace App;

use App\Pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','village_id','id_pengguna','users_id','categories_id','price','description','slug','stock','status'];

    protected $hidden = [];

     public function galleries(){
         return $this->hasMany(ProductGallery::class, 'products_id','id');
     }

    public function user(){
         return $this->hasOne(User::class, 'id','users_id');
    }

    public function pengguna(){
        return $this->hasOne(Pengguna::class, 'id_pengguna','users_id');
    }

     public function category(){
         return $this->belongsTo(Category::class, 'categories_id','id');
     }
}
