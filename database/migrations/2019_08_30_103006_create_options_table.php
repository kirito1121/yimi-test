<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('03_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->boolean('default')->default(0);
            $table->integer('index')->default(0);
            // $table->unsignedInteger('extra_id');
            // $table->foreign('extra_id')->references('id')->on('03_extras');
            $table->unsignedInteger('extra_id')->foreign('extra_id')->references('id')->on('03_extras');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('03_options');
    }
}
