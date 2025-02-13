<?php

namespace App\Models;

use App\Models\Demande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;
    use SoftDeletes; // 👈 Assure-toi que cette ligne est présente


	protected $fillable = ['nom', 'description', 'nombre', 'femme', 'homme'];
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
