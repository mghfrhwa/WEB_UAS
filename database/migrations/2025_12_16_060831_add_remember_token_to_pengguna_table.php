<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->rememberToken(); // Ini otomatis membuat kolom VARCHAR(100) null
        });
    }

    public function down()
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropRememberToken();
        });
    }
};
