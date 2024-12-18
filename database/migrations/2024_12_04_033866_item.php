<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel items
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('uniq_id')->unique();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });


        Schema::create('item_location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->integer('quantity')->default(0); // Menambahkan kolom quantity
            $table->timestamps();
        });

        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
                $table->dropColumn('supplier_id');
            }
            if (Schema::hasColumn('items', 'location_id')) {
                $table->dropForeign(['location_id']);
                $table->dropColumn('location_id');
            }
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_location_quantity');
        Schema::dropIfExists('item_location');
        Schema::dropIfExists('item_supplier');
        Schema::dropIfExists('items');
    }
};
