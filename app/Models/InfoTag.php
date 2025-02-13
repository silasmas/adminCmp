<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoTag extends Model
{
    use HasFactory;

	protected $fillable = ['nom', 'description'];
	protected $table = "infoTags";
    public function setNomAttribute($value)
{
    if (is_array($value)) {
        foreach ($value as $tagName) {
            // Vérifie si le tag existe déjà, sinon l'ajoute
            $this::firstOrCreate(['nom' => $tagName]);
        }
    }

    // Stocke les tags sous format JSON
    $this->attributes['tags'] = json_encode($value);
}
}
