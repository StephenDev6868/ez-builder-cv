<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->bigInteger('credit')->nullable();
            $table->integer('limit')->nullable();
            $table->integer('useage')->default(0)->nullable();
            $table->dateTime('expiration_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('code', 'coupons_inx_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
