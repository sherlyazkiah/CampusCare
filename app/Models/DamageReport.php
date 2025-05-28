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
'report_name', 'description', 'user_id', 'role_id', 'room_id', 'floor_id',
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
}