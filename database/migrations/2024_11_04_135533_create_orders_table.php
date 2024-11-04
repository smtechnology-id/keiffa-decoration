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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('code_order')->unique();
            $table->string('bride_name');
            $table->string('groom_name');
            $table->date('wedding_date');
            $table->string('wedding_location');
            $table->string('wedding_theme');
            $table->integer('total_price');
            $table->integer('payment_total')->nullable();
            $table->enum('status_pembayaran', ['dp', 'full', 'done'])->default('dp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
