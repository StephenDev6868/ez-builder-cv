<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumecvtemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumecvtemplates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name', 190);
            $table->string('thumb', 190)->nullable();
            $table->longText('content')->nullable();
            $table->longText('style')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('is_premium')->default(false);
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
        Schema::dropIfExists('resumecvtemplates');
    }
}
