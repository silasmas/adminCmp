<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DjangoAdminLog extends Model
{
    protected $table = 'django_admin_log';

    public $timestamps = false;

    protected $fillable = [
        'action_time',
        'object_id',
        'object_repr',
        'action_flag',
        'change_message',
        'content_type_id',
        'user_id',
    ];

    protected $casts = [
        'action_time'   => 'datetime',
        'action_flag'   => 'integer',
        'content_type_id' => 'integer',
        'user_id'         => 'integer',
    ];

    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DjangoContentType::class, 'content_type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(AuthUser::class, 'user_id');
    }
}
