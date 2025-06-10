<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'Criteria';
    protected $primaryKey = 'criterion_id';
  public function scales()
    {
        return $this->hasMany(CriterionScale::class, 'criterion_id', 'criterion_id');
        // foreign key di CriteriaScale, primary key di Criteria
    }
}
