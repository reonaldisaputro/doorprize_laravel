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
        Schema::table('pesertas', function (Blueprint $table) {
            $table->string('merchant')->nullable();        // Merchant (optional)
            $table->string('titik_kumpul')->nullable();    // Titik kumpul
            $table->string('nomor_bus')->nullable();       // Nomor bus
            $table->string('kode_peserta')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {
            $table->dropColumn('merchant');
            $table->dropColumn('titik_kumpul');
            $table->dropColumn('nomor_bus');
            $table->dropColumn('kode_peserta');
        });
    }
};
