<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventory_cants', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_inventory_id');

            $table->foreign('product_inventory_id')
                ->references('id')
                ->on('product_inventories')
                ->onDelete('cascade');

            $table->bigInteger('cant');
            $table->enum('state', ['new', 'used']);

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
        Schema::dropIfExists('product_inventory_cants');
    }
};
