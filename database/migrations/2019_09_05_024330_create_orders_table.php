<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('04_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no')->comment('Mã order');
            $table->float('amount')->comment('Tổng tiền của order');
            $table->string('status')->comment('Trạng thái của order');
            $table->string('note')->nullable()->comment('Ghi chú của order');
            $table->unsignedInteger('store_id')->foreign('store_id')->references('id')->on('01_stores');
            $table->unsignedInteger('staff_id')->nullable()->foreign('staff_id')->references('id')->on('02_staff');
            $table->unsignedInteger('customer_id')->foreign('customer_id')->references('id')->on('02_customer');
            $table->timestamps();
        });

        Schema::create('04_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity')->comment('Số lượng của service');
            $table->float('amount')->comment('Tổng tiền của service bao gồm cả extra và số lượng');
            $table->string('status')->comment('Trạng thái của service trong order');
            $table->text('extras')->nullable()->comment('Extra mà người dùng đã chọn');
            $table->unsignedInteger('order_id')->foreign('order_id')->references('id')->on('04_orders');
            $table->unsignedInteger('service_id')->foreign('service_id')->references('id')->on('03_services');
            $table->timestamps();
        });

        Schema::create('04_bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no')->comment('Mã bill');
            $table->float('amount')->comment('Tổng tiền');
            $table->timestamps();
            $table->unsignedInteger('order_id')->foreign('order_id')->references('id')->on('04_orders');
            $table->unsignedInteger('store_id')->foreign('store_id')->references('id')->on('01_stores');
            $table->unsignedInteger('staff_id')->foreign('staff_id')->references('id')->on('02_staff');
            $table->unsignedInteger('customer_id')->foreign('customer_id')->references('id')->on('02_customer');
        });

        Schema::create('04_bill_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Tên của service');
            $table->string('description')->comment('mô tả service');
            $table->float('amount')->comment('Giá của service khi đã có quantity và extra');
            $table->integer('quantity')->comment('số lượng service');
            $table->text('extras')->nullable()->comment('Extra của service');
            $table->unsignedInteger('order_item_id')->foreign('order_item_id')->references('id')->on('04_order_items');
            $table->unsignedInteger('bill_id')->foreign('bill_id')->references('id')->on('04_bills');
            $table->timestamps();
        });

        Schema::create('04_order_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action')->comment('Hành động của người dùng lên order');
            $table->text('data')->comment('Dữ liệu hoạt động của người dùng lên order');
            $table->integer('order_id')->foreign('order_id')->references('id')->on('04_orders');
            $table->morphs('accountable');
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
        Schema::dropIfExists('04_order_histories');
        Schema::dropIfExists('04_bill_items');
        Schema::dropIfExists('04_bills');
        Schema::dropIfExists('04_order_items');
        Schema::dropIfExists('04_orders');
    }
}
