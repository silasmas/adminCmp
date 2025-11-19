<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestimonyAmen extends Model
{
    protected $table = 'wall_testimonyamen';

    protected $fillable = [
        'session_key',
        'user_email',
        'created_at',
        'testimony_id',
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function testimony(): BelongsTo
    {
        return $this->belongsTo(Testimony::class, 'testimony_id');
    }
}
