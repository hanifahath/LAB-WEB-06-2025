<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // bigint PRIMARY KEY, AUTO INCREMENT  
            $table->string('name'); // varchar(255)  
            $table->decimal('price', 15, 2); // decimal(15,2) 

            // foreign key 
            $table->foreignId('category_id')
                  ->nullable() 
                  ->constrained('categories')
                  ->onDelete('set null');
                  
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};