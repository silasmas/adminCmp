<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuthGroup extends Model
{
    protected $table = 'auth_group';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    /**
     * Permissions via table pivot auth_group_permissions.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            AuthPermission::class,
            'auth_group_permissions',
            'group_id',
            'permission_id'
        );
    }

    /**
     * Utilisateurs appartenant à ce groupe.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            AuthUser::class,
            'auth_user_groups',
            'group_id',
            'user_id'
        );
    }

    /**
     * Pivot direct (si besoin).
     */
    public function groupPermissions(): HasMany
    {
        return $this->hasMany(AuthGroupPermission::class, 'group_id');
    }
}
