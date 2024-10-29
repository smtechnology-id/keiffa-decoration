<?php

use Faker\Guesser\Name;
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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('packageSlug');
            $table->integer('harga');
            $table->string('deskripsi')->nullable();
            $table->string('properti');
            $table->string('jenis_bunga');
            $table->string('hand_bouquet');
            $table->string('dekorasi');
            $table->string('luas_dekorasi');
            $table->string('meja_angpao');
            $table->string('kotak_angpao');
            $table->string('isAvailable')->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
