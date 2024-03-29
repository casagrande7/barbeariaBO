<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDePagamento extends Model
{
    use HasFactory;
    protected $fillable =[
        'nome',
        'taxa',
        'status'
    ];
}
