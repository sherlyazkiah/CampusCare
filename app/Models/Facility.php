<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'facilities';

    protected $primaryKey = 'facility_id';

    protected $fillable = [
        'facility_name',
        'jumlah',
        'floor_id',
        'room_id',
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
