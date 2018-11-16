<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsertionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insertion_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('dbm_campaign_id');
            $table->integer('dbm_insertion_order_id');
            $table->string('io_name');
            $table->string('status');
            $table->string('pacing');
            $table->string('pacing_rate');

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
        Schema::dropIfExists('insertion_orders');
    }
}
