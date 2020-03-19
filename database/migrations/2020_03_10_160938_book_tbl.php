<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Books_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('BookName');
            $table->integer('BookPrice');
            $table->integer('BookRentPrice');
            $table->unsignedBigInteger('user_id');
            $table->enum('Status',array('available','unavailable'));
            $table->foreign('user_id')->references('id')->on('Users_tbl')->onDelete('cascade');
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
        //
    }
}
