<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthGroupPermission extends Model
{
    protected $table = 'auth_group_permissions';

    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'permission_id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(AuthGroup::class, 'group_id');
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(AuthPermission::class, 'permission_id');
    }
}
