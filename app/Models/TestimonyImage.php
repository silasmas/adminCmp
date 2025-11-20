<?php

namespace App\Models;

use Illuminate\Support\Str;
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
    // >>> IMPORTANT : ajouter ça <<<
    protected $appends = ['url'];


    /**
     * Retourne l'URL complète de l'image.
     * - Si en base c'est déjà un http(s), on le retourne.
     * - Sinon on préfixe avec ton domaine.
     */
    public function getUrlAttribute(): string
    {
        if (! $this->image) {
            return '';
        }


         // Si déjà une URL complète, on la renvoie telle quelle
    if (Str::startsWith($this->image, ['http://', 'https://'])) {
        return $this->image;
    }

    // Sinon on préfixe avec ton domaine
    $base = rtrim('https://temoignage.eglisecmp.com', '/');

    return $base . '/' . ltrim($this->image, '/');
    }
}
