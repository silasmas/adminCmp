<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthUserUserPermission extends Model
{
    protected $table = 'auth_user_user_permissions';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'permission_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AuthUser::class, 'user_id');
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(AuthPermission::class, 'permission_id');
    }
}
