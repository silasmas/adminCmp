<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuthPermission extends Model
{
    protected $table = 'auth_permission';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'content_type_id',
        'codename',
    ];

    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DjangoContentType::class, 'content_type_id');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            AuthGroup::class,
            'auth_group_permissions',
            'permission_id',
            'group_id'
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            AuthUser::class,
            'auth_user_user_permissions',
            'permission_id',
            'user_id'
        );
    }

    public function groupPermissions(): HasMany
    {
        return $this->hasMany(AuthGroupPermission::class, 'permission_id');
    }

    public function userPermissions(): HasMany
    {
        return $this->hasMany(AuthUserUserPermission::class, 'permission_id');
    }
}
