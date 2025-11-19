<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DjangoSession extends Model
{
    protected $table = 'django_session';

    protected $primaryKey = 'session_key';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'session_key',
        'session_data',
        'expire_date',
    ];

    protected $casts = [
        'expire_date' => 'datetime',
    ];
}
