<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

//use AzisHapidin\IndoRegion\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Province Model.
 */
class Province extends Model
{
    use HasFactory;
    /**
     * Table name.
     *
     * @var string
     */
    //protected $guarded=[];
    protected $table = "lahan";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','category_lahan_id','ukuran','deskripsi','gambar'];

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regencies()
    {
        return $this->belongsTo(Category_lahan::class);
    }
}
