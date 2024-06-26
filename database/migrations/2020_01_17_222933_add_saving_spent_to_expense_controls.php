<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSavingSpentToExpenseControls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expense_controls', function (Blueprint $table) {
            $table->decimal('spent', 13, 2)->default(0);
            $table->decimal('saving', 13, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expense_controls', function (Blueprint $table) {
            $table->dropColumn('saving');
            $table->dropColumn('spent');
        });
    }
}
