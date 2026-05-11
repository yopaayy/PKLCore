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
        Schema::create('dudis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Akun login perwakilan DU/DI
            $table->string('nama_perusahaan');
            $table->string('bidang_usaha');
            $table->decimal('latitude', 10, 8)->nullable(); // Persiapan untuk Live Map Tracking
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('kuota_siswa')->default(0);
            $table->enum('status_kerjasama', ['Aktif', 'Pending', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dudis');
    }
};
