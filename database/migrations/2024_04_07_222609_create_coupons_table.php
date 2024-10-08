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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('quantity');
            $table->integer('max_use');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->double('discount');
            $table->enum('discount_type', ['percentage', 'cash']);
            $table->enum('status', ['active', 'inactive']);
            $table->integer('total_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
