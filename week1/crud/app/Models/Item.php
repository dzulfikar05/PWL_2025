<?php

namespace App\Models;  // define bahwa file ini terletak di folder app/Models

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory
use Illuminate\Database\Eloquent\Model; // Import Model

class Item extends Model // Class Item mewarisi dari class Model
{
    use HasFactory; // Menggunakan HasFactory

    protected $guarded = [];

    // protected $fillable = [ // Atribut yang dapat diisi
    //     'name',
    //     'description',
    // ];
}
