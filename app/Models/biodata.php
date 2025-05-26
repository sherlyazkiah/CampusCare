<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'id_user',
        'name',
        'role_id',
        'username',
        'title',
        'email',
    ];

    /**
     * Relasi ke tabel users berdasarkan id_user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke tabel users berdasarkan username
     */
    public function usernameRelation()
    {
        return $this->belongsTo(User::class, 'username');
    }

    /**
     * Relasi ke tabel roles
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
