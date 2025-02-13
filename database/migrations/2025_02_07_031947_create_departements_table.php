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
		Schema::create('departements', function (Blueprint $table) {
        	$table->id();
        	$table->string('nom');
			$table->text('description');
			$table->integer('nombre');
			$table->integer('femme');
			$table->integer('homme')->nullable();
        	$table->timestamps();
            $table->softDeletes(); // 👈 Ajoute la colonne deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
    }
};
