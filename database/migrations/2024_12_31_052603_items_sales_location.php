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
        Schema::create('items_sales_location', function (Blueprint $table){
            $table->id();
            $table->foreignId('item_sales_id')->constrained('items_sales')->onDelete('cascade');
            $table->foreignId('item_location_id')->constrained('item_location')->onDelete('cascade');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_sales_location');
    }
};
