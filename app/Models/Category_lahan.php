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
class Category_lahan extends Model
{
    use HasFactory;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'category_lahan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','nama'
    ];

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lahan()
    {
        return $this->hasMany(Lahan::class);
    }
}