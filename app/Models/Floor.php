<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'floor_id'; // sesuai dengan skema
    protected $fillable = ['floor_number', 'floor_name'];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'floor_id');
    }
}
