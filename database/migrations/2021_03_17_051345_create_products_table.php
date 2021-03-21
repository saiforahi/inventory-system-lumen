<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('sell_price')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('buy_price')->nullable();
            $table->string('image')->nullable();
            $table->string('capacity')->nullable();
            $table->string('power')->nullable();
            $table->string('voltage')->nullable();
            $table->string('power_source')->nullable();
            $table->date('arrival_date')->nullable();
            $table->string('remaining_quantity')->nullable();
            $table->date('receive_date')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
