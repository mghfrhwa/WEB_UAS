<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->decimal('harga_total', 15, 2)->default(0)->after('kode_pesanan');
            $table->decimal('jumlah_dp', 15, 2)->default(0)->after('harga_total');
            $table->enum('status_pembayaran', ['belum_bayar', 'dp', 'lunas'])
                  ->default('belum_bayar')->after('jumlah_dp');
        });
    }

    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['harga_total', 'jumlah_dp', 'status_pembayaran']);
        });
    }
};