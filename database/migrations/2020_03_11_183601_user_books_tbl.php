<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserBooksTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserBooks_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('BookID');
            $table->unsignedBigInteger('UserID');
            $table->enum('Status',array('Buy','Rent'));
            $table->enum('RentStatus',array('InUse','Finished'))->nullable();
            $table->foreign('BookID')->references('id')->on('Books_tbl')->onDelete('cascade');
            $table->foreign('UserID')->references('ID')->on('Users_tbl')->onDelete('cascade');
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
