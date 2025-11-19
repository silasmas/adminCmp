<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DjangoContentType extends Model
{
    protected $table = 'django_content_type';

    public $timestamps = false;

    protected $fillable = [
        'app_label',
        'model',
    ];

    public function permissions(): HasMany
    {
        return $this->hasMany(AuthPermission::class, 'content_type_id');
    }

    public function adminLogs(): HasMany
    {
        return $this->hasMany(DjangoAdminLog::class, 'content_type_id');
    }
}
