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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->enum('shift', ['Siang', 'Malam']);
            $table->enum('session', ['Kedatangan', 'Kepulangan']);
            $table->string('name', 50);
            $table->enum('status', ['Hadir', 'Izin', 'Tanpa Keterangan', 'Telat']);
            $table->string('status_note', 100)->nullable();
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
