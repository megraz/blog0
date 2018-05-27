<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->boolean('is_enabled')->default(false);
            $table->timestamps();
        });
    }
          // Schema::create('articles', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title');
        //     $table->text('content');
        //     $table->boolean('is_enabled')->default(false);
        //     $table->timestamps();

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
    
}
