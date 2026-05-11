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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Siswa yang mengajukan
            $table->foreignId('dudi_id')->constrained('dudis')->cascadeOnDelete(); // Perusahaan yang dituju

            $table->enum('status', ['Draft', 'Pending', 'Approved', 'Rejected'])->default('Pending');

            $table->text('pesan_siswa')->nullable(); // Pesan atau motivasi siswa memilih tempat ini
            $table->text('catatan_admin')->nullable(); // Alasan jika ditolak, atau pesan dari admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
