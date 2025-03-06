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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('table_id')->constrained('tables')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('order_date');
            $table->date('payment_date')->nullable();
            $table->enum('status', ['payed', 'order', 'pending', 'canceled']);
            $table->bigInteger('total_discount')->nullable();
            $table->bigInteger('total_amount')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
