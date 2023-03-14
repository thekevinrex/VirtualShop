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
        Schema::create('variantes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('variante_cate_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->foreign('variante_cate_id')
                ->references('id')
                ->on('variante_cates')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();

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
        Schema::dropIfExists('variantes');
    }
};
