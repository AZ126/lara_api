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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
              $table->char('uuid', 36)->unique();
            $table->string('reference', 64)->unique();
            
            // Foreign Keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            
            // Financial Data (Precision: 18 total digits, 6 decimal places)
            $table->enum('type', ['debit', 'credit']);
            $table->decimal('amount', 18, 6)->default(0);
            $table->decimal('fee', 18, 6)->default(0);
            $table->decimal('net_amount', 18, 6)->default(0);
            
            // Transaction Details
            $table->enum('status', ['pending', 'completed', 'failed', 'reversed'])->default('pending');
            $table->string('idempotency_key', 100)->nullable()->index();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
