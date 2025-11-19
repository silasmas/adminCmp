<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wall_verificationcode', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('email', 191)->unique();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('code', 64)->unique();

            $table->dateTime('created_at');
            $table->dateTime('expires_at');

            $table->boolean('used');
            $table->unsignedInteger('attempts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wall_verificationcode');
    }
};
