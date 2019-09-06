<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('03_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Tên service');
            $table->string('unit')->comment('Đơn vị');
            $table->text('description')->comment('Chi tiết của service');
            $table->text('image')->nullable()->comment('Chi tiết của service');
            $table->text('extras')->nullable()->comment('Json extra');
            $table->integer('price')->comment('Giá service');
            $table->integer('minutes')->comment('Thời gian làm service');
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
        Schema::dropIfExists('03_services');
    }
}
