<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CriterionScale extends Model
{
    use HasFactory;

    protected $table = 'Criterion_Scales';

    protected $fillable = [
        'criterion_id',
        'scale_value',
        'scale_description',
    ];

    // Relasi ke tabel criteria
     public function criterion()
    {
        return $this->belongsTo(Criteria::class, 'criterion_id', 'criterion_id');
        // foreign key di CriteriaScale, primary key di Criteria
    }
}
