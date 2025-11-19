<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuthUser extends Model
{
    protected $table = 'auth_user';

    public $timestamps = false;

    protected $fillable = [
        'password',
        'last_login',
        'is_superuser',
        'username',
        'first_name',
        'last_name',
        'email',
        'is_staff',
        'is_active',
        'date_joined',
    ];

    protected $casts = [
        'last_login'  => 'datetime',
        'date_joined' => 'datetime',
        'is_superuser' => 'boolean',
        'is_staff'     => 'boolean',
        'is_active'    => 'boolean',
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            AuthGroup::class,
            'auth_user_groups',
            'user_id',
            'group_id'
        );
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            AuthPermission::class,
            'auth_user_user_permissions',
            'user_id',
            'permission_id'
        );
    }

    public function adminLogs(): HasMany
    {
        return $this->hasMany(DjangoAdminLog::class, 'user_id');
    }

    public function userGroups(): HasMany
    {
        return $this->hasMany(AuthUserGroup::class, 'user_id');
    }

    public function userPermissionsPivot(): HasMany
    {
        return $this->hasMany(AuthUserUserPermission::class, 'user_id');
    }
}
