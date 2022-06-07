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
class Peralatan extends Model
{
    use HasFactory;
    /**
     * Table name.
     *
     * @var string
     */
    //protected $guarded=[];
    protected $table = "peralatan";
    public $timestamps = false;
    protected $primaryKey = "id_peralatan";
    protected $fillable = [
        'id_peralatan','nama_alat','harga','deskripsi','id_pemilik','updated_at'];

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regencies()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
