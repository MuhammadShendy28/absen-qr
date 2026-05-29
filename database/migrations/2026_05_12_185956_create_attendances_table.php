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
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('schedule_id');
            $table->enum('status', [
                'hadir',
                'telat',
                'izin',
                'absen'
        ]);
            $table->time('scan_time')->nullable();
            $table->timestamps();

      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
