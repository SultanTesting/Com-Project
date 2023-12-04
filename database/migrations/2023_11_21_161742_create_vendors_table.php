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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('banner')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->text('address')->nullable();
            $table->text('shop_description')->nullable();
            $table->enum('store_status', ['Open', 'Close', 'Permanently_Closed']);
            $table->text('facebook')->nullable();
            $table->text('x')->nullable();
            $table->text('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
