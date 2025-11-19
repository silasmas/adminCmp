<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestimonyImage extends Model
{
    protected $table = 'wall_testimonyimage';

    protected $fillable = [
        'image',
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
