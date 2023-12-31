<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_to_permission', 'permission_id', 'role_id');
    }
}
