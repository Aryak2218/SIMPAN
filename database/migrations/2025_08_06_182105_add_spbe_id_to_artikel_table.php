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
        Schema::table('artikel', function (Blueprint $table) {
            $table->unsignedBigInteger('spbe_id')->nullable(); // Nullable jika artikel bisa dibuat tanpa SPBE
            $table->foreign('spbe_id')->references('id')->on('pengetahuan_spbe')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artikel', function (Blueprint $table) {
            //
        });
    }
};
