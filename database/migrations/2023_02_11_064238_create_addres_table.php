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
        Schema::create('addresses', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('addresable_id');
            $table->string('addresable_type');

            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('municipality_id');

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade');

            $table->foreign('municipality_id')
                ->references('id')
                ->on('municipalities')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('location');
            $table->text('preferences')->nullable();

            $table->json('aviable_days')->nullable();
            $table->boolean('default')->default(false);

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
        Schema::dropIfExists('addresses');
    }
};
