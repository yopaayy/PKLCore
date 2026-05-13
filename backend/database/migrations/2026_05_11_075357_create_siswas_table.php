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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nisn', 10)->unique();
            $table->string('kelas');

            // Relasi ke Guru Pembimbing dan Tempat PKL
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->nullOnDelete();
            $table->foreignId('dudi_id')->nullable()->constrained('dudis')->nullOnDelete();

            // Status Workflow Realtime
            $table->enum('status_pkl', ['Belum Pengajuan', 'Menunggu Approval', 'Aktif PKL', 'Selesai'])->default('Belum Pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
