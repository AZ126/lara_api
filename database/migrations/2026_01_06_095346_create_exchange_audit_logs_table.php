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
        Schema::create('exchange_audit_logs', function (Blueprint $table) {
            $table->id();
            // Nullable Foreign Key for cases like system-level actions
            // Column modifier nullable() must come before constrained()
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->string('action', 100);
            $table->string('entity_type', 50)->index(); // Indexed for faster filtering
            $table->bigInteger('entity_id')->index();

            $table->ipAddress('ip_address')->nullable(); // Standard IP address column
            $table->text('user_agent')->nullable(); // Text used for longer user agent strings
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_audit_logs');
    }
};
