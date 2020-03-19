<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('Book_Tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Book_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            $table->unique(['Book_id','tag_id']);
            $table->foreign('Book_id')->references('id')->on('Books_tbl')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('Tags')->onDelete('cascade');
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
