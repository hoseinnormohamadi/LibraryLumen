<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Payment_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('Book_id');
            $table->foreign('user_id')->references('ID')->on('Users_tbl')->onDelete('cascade');
            $table->foreign('Book_id')->references('id')->on('Books_tbl')->onDelete('cascade');
            $table->integer('Amount');
            $table->enum('Book_Status',array('Buy','Rent'));
            $table->enum('Payment_Status',array('Cleared','AwaitingPayment'));
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
