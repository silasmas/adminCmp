<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MemberProfile extends Model
{
    protected $table = 'wall_memberprofile';

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false; // on gère created_at / updated_at nous-mêmes ou via events

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Témoignages liés à ce profil via l'email.
     */
    public function testimonies(): HasMany
    {
        return $this->hasMany(Testimony::class, 'email', 'email');
    }
}
