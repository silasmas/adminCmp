<?php

namespace App\Models;

use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demande extends Model
{
    use HasFactory;
    use SoftDeletes; // 👈 Assure-toi que cette ligne est présente
    protected $casts = [
        'formatImpression' => 'array',
        'invites' => 'array',
        'orateurs' => 'array',
    ];
	protected $guarded = [];
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}
