<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseControlDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_control_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('expense_control_id');
            $table->unsignedBigInteger('expense_type_id');
            $table->decimal('value', 13, 2);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('expense_control_id')->references('id')->on('expense_controls');
            $table->foreign('expense_type_id')->references('id')->on('expense_types');
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
        Schema::dropIfExists('expense_control_details');
    }
}
