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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // seller
            $table->string('title');
            $table->text('description');
            $table->decimal('starting_price', 12, 2);
            $table->decimal('current_price', 12, 2)->nullable();
            $table->string('image')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->enum('status', ['pending', 'active', 'closed'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
