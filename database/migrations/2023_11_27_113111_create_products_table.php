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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('child_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->text('thumb_image');
            $table->integer('quantity');
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->text('video_link')->nullable();
            $table->string('SKU')->nullable();
            $table->double('price');
            $table->double('offer_price')->nullable();
            $table->date('offer_start_data')->nullable();
            $table->date('offer_end_data')->nullable();
            $table->enum('top', ['yes', 'no'])->nullable();
            $table->enum('best', ['yes', 'no'])->nullable();
            $table->enum('featured', ['yes', 'no'])->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->enum('approved', ['pending', 'published', 'failed'])->default('pending');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
