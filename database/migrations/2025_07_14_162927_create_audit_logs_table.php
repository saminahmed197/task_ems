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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_type'); // e.g. UPDATE, DELETE, CREATE
            $table->text('description')->nullable(); // e.g. "Client email updated from X to Y"
            $table->string('impact_module'); // e.g. "Client Management", "Holdings"
            $table->unsignedBigInteger('user_id')->nullable(); // actor
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
