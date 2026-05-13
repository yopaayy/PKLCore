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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Kolom ini akan otomatis diisi dari nomor WA di profil user
            $table->string('nomor_whatsapp_pembayar');

            $table->decimal('jumlah_bayar', 10, 2);
            $table->string('metode_pembayaran')->nullable(); // misal: Transfer Bank, e-Wallet
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->string('bukti_transfer_path')->nullable(); // Untuk upload struk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
