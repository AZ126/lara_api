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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            
            // Foreign Keys
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('sender_user_id')->constrained('users')->onDelete('cascade');
            
            // Receiver Information
            $table->string('receiver_name');
            $table->string('receiver_country');
            $table->string('receiver_account');
            
            // Currency and Exchange Details
            $table->decimal('exchange_rate', 18, 6);
            $table->char('source_currency', 3);
            $table->char('target_currency', 3);
            
            // Status and Timestamps
            $table->enum('status', ['initiated', 'processing', 'completed', 'failed'])->default('initiated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
