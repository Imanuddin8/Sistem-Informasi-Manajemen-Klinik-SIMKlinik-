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
        Schema::create('registrasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')
                ->constrained('pasien')
                ->onDelete('cascade');
            $table->foreignId('dokter_id')
              ->nullable()
              ->constrained('users')
              ->onDelete('set null');
            $table->foreignId('staff_id')
              ->nullable()
              ->constrained('users')
              ->onDelete('set null');
            $table->string('keluhan');
            $table->datetime('tanggal');
            $table->text('keterangan');
            $table->enum('status', ['belum masuk', 'sudah masuk', 'batal', 'sudah diperiksa'])->default('belum masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi');
    }
};
