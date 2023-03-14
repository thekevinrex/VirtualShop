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
        Schema::create('address', function (Blueprint $table) {

            $table->unsignedBigInteger('addresable_id');
            $table->string('addresable_type');

            $table->primary(['addresable_id', 'addresable_type']);

            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('municipio_id');

            $table->foreign('provincia_id')
                ->references('id')
                ->on('provincias')
                ->onDelete('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on('municipios')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('location');
            $table->text('aditional')->nullable();

            $table->json('aviable_days')->nullable();
            $table->enum('default', [0, 1])->default(0);

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
        Schema::dropIfExists('addres');
    }
};
