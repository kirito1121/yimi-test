<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('03_extras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Tên extra');
            $table->string('slug')->comment('Tên extra slug');
            $table->boolean('multiple')->default(0)->comment('loại extra được chon nhiều hay 1');
            $table->integer('index')->default(0)->comment('Bị trí của extra');
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
        Schema::dropIfExists('03_extras');
    }
}
