<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('03_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Tên nhóm');
            $table->integer('index')->default(0)->comment('Vị trí của menu');
            $table->integer('parent_id')->nullable()->comment('Quan hệ cha con');
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
        Schema::dropIfExists('03_menus');
    }
}
