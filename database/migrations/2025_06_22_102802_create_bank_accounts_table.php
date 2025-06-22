<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->enum('BANK', ['BCA', 'Mandiri', 'BRI', 'BSI']);      // Contoh: BCA, BRI, Mandiri
            $table->string('rekening');    // Nomor rekening
            $table->string('nama');      // Nama pemilik rekening
            $table->boolean('is_active')->default(true); // Bisa nonaktifkan sementara
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
