<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HomeSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_seo',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('title',1000);
            $table->string('share_title',1000);
            $table->string('description',2000);
            $table->string('keywords',1000);
            $table->string('page_img',1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
