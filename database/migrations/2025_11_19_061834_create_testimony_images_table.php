<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wall_testimonyimage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image', 100);
            $table->dateTime('created_at');
            $table->unsignedBigInteger('testimony_id');

            $table->index('testimony_id', 'wall_testimonyimage_testimony_id_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wall_testimonyimage');
    }
};
