<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColStatusIntoHistoryCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_credits', function (Blueprint $table) {
            $table->tinyInteger('status')->nullable()->comment('1 plus | 2 minus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_credits', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
