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
'report_name', 'description', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'status', 'user_id', 'role_id', 'room_id', 'floor_id', 'image_path' ,'facility_id'
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

public function facility()
{
    return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
}

public function biodata()
{
    return $this->belongsTo(biodata::class, 'id_user', 'id_user');
}
    
}