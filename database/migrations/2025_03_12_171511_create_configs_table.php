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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            //Site Config
            $table->string('site_title')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('site_icon')->nullable();

            // Home Page Config
                // Header
                $table->string('header_image')->nullable();
                $table->string('header_title')->nullable();
                $table->string('header_description')->nullable();

                // Head Chef
                $table->string('head_chef_photo')->nullable();
                $table->text('head_chef_description')->nullable();
                // Gallery
                $table->text('gallery')->nullable();
                // Footer
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('tel')->nullable();
                $table->string('address')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
