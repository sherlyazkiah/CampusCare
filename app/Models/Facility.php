<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facility'; // Nama tabel eksplisit jika tidak mengikuti konvensi jamak
    protected $fillable = ['facility_name', 'facility_description'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
