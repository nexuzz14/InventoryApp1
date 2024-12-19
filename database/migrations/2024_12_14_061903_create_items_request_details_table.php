<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items_request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('request_items')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('quantity_accepted')->nullable();
            $table->integer('quantity_buy')->nullable();
        });

        Schema::create('items_request_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('items_request_detail_id')->constrained('items_request_details')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->bigInteger('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_request_details');
    }
};
