<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wall_memberprofile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 191)->unique();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wall_memberprofile');
    }
};
