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
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('request_id')->constrained('request_items')->onDelete('cascade');
            $table->integer('total_qty');
            $table->decimal("total_price", 10, 2);
            $table->decimal("dibayarkan", 10, 2)->default(0);
            $table->integer("total_appoved_items");
            $table->enum("status", ["paid", "unpaid", "Bon"]);
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
