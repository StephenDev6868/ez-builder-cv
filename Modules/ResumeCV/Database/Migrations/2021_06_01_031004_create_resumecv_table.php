<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumecvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumecv', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 36)->index(); // uuid
            $table->integer('user_id')->unsigned();
            $table->string('name', 190);
            $table->longText('content')->nullable();
            $table->longText('style')->nullable();
            $table->boolean('is_publish')->default(true);
            $table->integer('view_count')->default(0);
            $table->string('slug', 190)->nullable(); //for publish landingpage
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
        Schema::dropIfExists('resumecv');
    }
}
