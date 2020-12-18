<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductsTableMakeQuantityNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->change();
            $table->integer('total')->nullable()->change();
            $table->integer('price')->nullable()->change();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->text('description')->nullable();
            $table->integer('sale_price')->nullable();
            $table->string('barcode')->nullable();
            $table->boolean('allow')->default(true);
            $table->boolean('featured')->default(false);
            $table->boolean('has_variants')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
