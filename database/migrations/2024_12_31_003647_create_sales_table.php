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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string("code_invoice", 255)->nullable();
            $table->string("code_proyek", 255);
            $table->foreignId('client_id')->constrained("clients")->onDelete('cascade');
            $table->decimal('total', 15, 2)->nullable();
            $table->enum('status', ['belum', 'dibayar'])->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
