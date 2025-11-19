<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $table = 'wall_verificationcode';

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'code',
        'created_at',
        'expires_at',
        'used',
        'attempts',
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];
}
