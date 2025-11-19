<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimony extends Model
{
    protected $table = 'wall_testimony';

    protected $fillable = [
        'kind',
        'first_name',
        'last_name',
        'title',
        'text',
        'video',
        'video_file',
        'postit_color',
        'font_family',
        'category',
        'email',
        'phone',
        'verification_type',
        'status',
        'created_at',
    ];

    public $timestamps = false; // pas de updated_at dans la table

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Images associées à ce témoignage.
     */
    public function images(): HasMany
    {
        return $this->hasMany(TestimonyImage::class, 'testimony_id');
    }

    /**
     * "Amen" reçus sur ce témoignage.
     */
    public function amens(): HasMany
    {
        return $this->hasMany(TestimonyAmen::class, 'testimony_id');
    }

    /**
     * Lien logique vers MemberProfile via l'email (pas de vraie FK).
     */
    public function memberProfile(): BelongsTo
    {
        return $this->belongsTo(MemberProfile::class, 'email', 'email');
    }
}
