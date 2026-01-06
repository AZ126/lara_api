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
        Schema::create('exchange_api_tokens', function (Blueprint $table) {
            $table->id();
            // Polymorphic relationship (tokenable_id and tokenable_type)
            // Use numericMorphs() for BIGINT or uuidMorphs() for UUID-based models
            $table->morphs('tokenable'); 
            
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            
            // Usage and Expiration
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_api_tokens');
    }
};
