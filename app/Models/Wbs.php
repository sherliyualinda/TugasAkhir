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
class Sewa_lahan extends Model
{
    use HasFactory;
    /**
     * Table name.
     *
     * @var string
     */
    //protected $guarded=[];
    protected $table = "wbs";
    public $timestamps = false;
    //protected $primaryKey = "id_penyewa";
    protected $fillable = [
        'id_wbs','id_kegiatan','qty','harga','totalHarga'];

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

}
