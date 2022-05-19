<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttags extends Model
{
    use HasFactory;
    protected $fillable=[
        'tag',
        'descripcion',
        'operacion',
        'ubicacion',
        'ct',
        'planta',
        'area',
        'foto'
    ];
}
