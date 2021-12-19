<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCartsTableAddIsGiftCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->boolean('is_gift_card')->default(false);
            $table->string('gift_card_to_name')->nullable();
            $table->string('gift_card_to_email')->nullable();
            $table->string('gift_card_comment')->nullable();
            $table->string('gift_card_from_name')->nullable();
            $table->string('gift_card_from_email')->nullable();
            $table->string('gift_card_token')->nullable();
            $table->bigInteger('gift_card_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('gift_card_token','gift_card_amount','gift_card_from_email','gift_card_from_name','is_gift_card','gift_card_to_name','gift_card_to_email','gift_card_comment')->default(false);
        });
    }
}
