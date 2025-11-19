<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_warehouse', function (Blueprint $table) {
            //foreign key product_id 
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade'); 

            // foreign key warehouse_id 
            $table->foreignId('warehouse_id')
                  ->constrained('warehouses')
                  ->onDelete('cascade'); 
             
            $table->integer('quantity')->default(0); // jumlah stok
            
            // primary key gabungan 
            $table->primary(['product_id', 'warehouse_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_warehouse');
    }
};