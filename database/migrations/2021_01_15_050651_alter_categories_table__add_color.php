<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCategoriesTableAddColor extends Migration
{
    
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('text_color')->nullable();
        });
    }

    
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('text_color');
        });
    }
}
