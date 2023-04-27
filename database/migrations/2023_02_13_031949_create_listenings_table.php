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
            $table->uuid()->unique();
            
            $table->string('name');
            $table->string('name_secondary')->nullable();

            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('category_id');
            
            $table->foreign('model_id')
                ->references('id')
                ->on('brand_models')
                ->onDelete('set null');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

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
