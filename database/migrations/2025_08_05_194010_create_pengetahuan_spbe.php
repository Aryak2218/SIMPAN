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
        Schema::create('pengetahuan_spbe', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_id')->unique();
        $table->string('judul');
        $table->string('slug')->unique();
        $table->text('deskripsi')->nullable();
        $table->text('excerpt')->nullable(); // opsional
        $table->foreignId('artikel_id')->nullable()->constrained('artikel')->onDelete('set null');
        $table->foreignId('kategori_id')->nullable()->constrained('kategori_artikel')->onDelete('set null');
        $table->foreignId('penulis_id')->nullable()->constrained('users')->onDelete('set null');
        $table->string('instansi')->nullable();
        $table->dateTime('waktu')->nullable();
        $table->string('format')->nullable(); // pdf, docx, mp4, png, dst
        $table->text('lingkup')->nullable(); // bisa jadi teks atau json
        $table->text('label')->nullable(); // keyword/tag
        $table->text('kontributor')->nullable();
        $table->enum('status_publikasi', ['publik', 'internal'])->default('publik');
        $table->string('url')->nullable(); // tautan akses (bisa dari storage atau luar)
        $table->string('file_path')->nullable(); // path ke file unggahan
        $table->timestamps();
    });

        Schema::create('pengetahuan_tag', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('slug')->unique();
        $table->timestamps();
    });

        Schema::create('pengetahuan_spbe_tag', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pengetahuan_id')->constrained('pengetahuan_spbe')->onDelete('cascade');
        $table->foreignId('tag_id')->constrained('pengetahuan_tag')->onDelete('cascade');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengetahuan_spbe');
        Schema::dropIfExists('pengetahuan_tag');
        Schema::dropIfExists('pengetahuan_spbe_tag');
    }
};
