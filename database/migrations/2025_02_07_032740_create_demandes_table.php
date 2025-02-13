<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		Schema::create('demandes', function (Blueprint $table) {
        	$table->id();
        	$table->string('prenom');
        	$table->string('nom');
        	$table->string('fonction');
        	$table->string('phone');
        	$table->string('whatsapp');
        	$table->string('email');
        	$table->string('type');
			$table->string('theme')->nullable();
			$table->datetime('dateDebut')->nullable();
			$table->datetime('dateFin')->nullable();
			$table->json('orateurs')->nullable();
			$table->json('invites')->nullable();
			$table->string('lieu')->nullable();
			$table->text('autresInfos')->nullable();
			$table->json('formatImpression')->nullable();
			$table->boolean('impression')->nullable();
			$table->boolean('communication')->nullable();
			$table->text('description')->nullable();
			$table->string('etat')->default('en attente');
			$table->text('raison')->nullable();
			$table->text('reponduPar')->nullable();
        	$table->timestamps();
            $table->softDeletes(); // 👈 Ajoute la colonne deleted_at
        });
        Schema::table('demandes', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Departement::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
