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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            $table->softDeletes(); // Add this for soft delete functionality
            $table->unsignedBigInteger('deleted_by_id')->nullable(); // Add deleted_by_id field
            $table->foreign('deleted_by_id')->references('id')->on('users'); // Assume you're using 'users' table for user reference
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_orders');
    }
};
