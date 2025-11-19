
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wall_testimony', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('kind', 10); // ex: text, video, mix
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('title', 255);

            $table->longText('text')->nullable();
            $table->string('video', 200)->nullable();
            $table->string('video_file', 100)->nullable();

            $table->string('postit_color', 20);
            $table->string('font_family', 100);
            $table->string('category', 100)->nullable();

            $table->string('email', 254);
            $table->string('phone', 30);

            $table->string('verification_type', 10); // email, phone, both...
            $table->string('status', 10);            // pending, approved, rejected, hidden...

            $table->dateTime('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wall_testimony');
    }
};
