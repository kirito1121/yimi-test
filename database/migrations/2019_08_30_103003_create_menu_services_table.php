<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('03_menu_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('index')->default(0)->comment('Vị trí của service');
            $table->integer('price')->comment('Giá custom của service');
            $table->boolean('hot')->default(0);
            $table->unsignedInteger('service_id')->foreign('service_id')->references('id')->on('03_menus');
            $table->unsignedInteger('menu_id')->foreign('menu_id')->references('id')->on('03_services');
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
        Schema::dropIfExists('03_menu_services');
    }
}
