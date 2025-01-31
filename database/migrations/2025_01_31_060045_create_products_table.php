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
            $table->string('title');
            $table->text('images');
            $table->string('description');
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('price');
            $table->string('discount')->nullable();
            $table->date('discount_end')->nullable();
            $table->string('inventory');
            $table->string('slug');
            $table->softDeletes();
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
