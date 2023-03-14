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
        Schema::create('listenings', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('second_name')->nullable();

            $table->unsignedBigInteger('marca_id')->nullable();

            $table->foreign('marca_id')
                ->references('id')
                ->on('marcas')
                ->onDelete('set null');

            $table->unsignedBigInteger('modelo_id')->nullable();

            $table->foreign('modelo_id')
                ->references('id')
                ->on('modelos')
                ->onDelete('set null');

            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->unsignedBigInteger('sub_category_id')->nullable();

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
        Schema::dropIfExists('listenings');
    }
};
