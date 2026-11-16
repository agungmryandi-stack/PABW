<?php

namespace Modules\TitikDrainase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\TitikDrainase\Database\Factories\TitikDrainaseFactory;

class TitikDrainase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['nama_titik','kecamatan','deskripsi','kedalaman_cm'];

    // protected static function newFactory(): TitikDrainaseFactory
    // {
    //     // return TitikDrainaseFactory::new();
    // }
}
