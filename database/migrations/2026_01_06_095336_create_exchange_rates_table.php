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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->char('base_currency', 3)->index();
            $table->char('target_currency', 3)->index();
            
            // Financial Precision: 18 total digits, 8 decimal places
            $table->decimal('rate', 18, 8);
            
            $table->string('provider', 50)->nullable();
            
            // Timestamp of when the rate was actually pulled from the provider
            $table->timestamp('fetched_at')->useCurrent();
            
            // Standard Laravel timestamps for record creation/updates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
