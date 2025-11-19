<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wall_testimonyamen', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('session_key', 64);
            $table->string('user_email', 254);
            $table->dateTime('created_at');

            $table->unsignedBigInteger('testimony_id');
            $table->index('testimony_id', 'wall_testimonyamen_testimony_id_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wall_testimonyamen');
    }
};
