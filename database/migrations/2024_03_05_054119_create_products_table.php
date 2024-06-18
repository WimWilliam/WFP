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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            //Menambah column name, desripsi, type_product, hotel_id pada table products
            $table->string('name', 100);
            $table->string('deskripsi', 255);

            //Menambah foreign key type_product pada table products (dengan mengambil id table typesproducts)
            $table->unsignedBigInteger('type_product');
            $table->foreign('type_product')->references('id')->on('typesproducts');

            //Menambah foreign key hotel_id pada table products (dengan mengambil id table hotels)
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
