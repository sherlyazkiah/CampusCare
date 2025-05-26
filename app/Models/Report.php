<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'floor',
        'class',
        'facility',
        'damage_scale',
        'description',
        'date',
        'image'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
