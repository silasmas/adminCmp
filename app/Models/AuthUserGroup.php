<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthUserGroup extends Model
{
    protected $table = 'auth_user_groups';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AuthUser::class, 'user_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(AuthGroup::class, 'group_id');
    }
}
