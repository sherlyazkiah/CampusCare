<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
use HasFactory;

protected $primaryKey = 'damage_report_id';

protected $table = 'damage_report';

protected $fillable = [
'report_name', 'description', 'damage_level', 'status', 'user_id', 'role_id', 'room_id', 'floor_id', 'image_path'
];

public function user()
{
return $this->belongsTo(User::class);
}

public function role()
{
return $this->belongsTo(Role::class, 'role_id', 'role_id');
}

public function room()
{
return $this->belongsTo(Room::class, 'room_id', 'room_id');
}

public function floor()
{
return $this->belongsTo(Floor::class, 'floor_id', 'floor_id');
}
    public const DAMAGE_LEVELS = [
        1 => 'Very Minor (Minimal Damage)',
        2 => 'Minor (Still Functions Well)',
        3 => 'Moderate (Function Disrupted)',
        4 => 'Major (Hardly Functions)',
        5 => 'Severe (Not Usable)',
    ];
}