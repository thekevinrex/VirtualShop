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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('seller_id');

            $table->foreign('seller_id')
                ->references('id')
                ->on('sellers')
                ->onDelete('cascade');

            $table->unsignedBigInteger('by_seller_id')->nullable();

            $table->foreign('by_seller_id')
                ->references('id')
                ->on('sellers')
                ->onDelete('cascade');

            $table->unsignedBigInteger('listening_id'); // proporciona cate_id, sub_cate_id, marca, modelo, detail_modelo

            $table->foreign('listening_id')
                ->references('id')
                ->on('listenings')
                ->onDelete('set null');

            $table->string('name');
            $table->uuid();
            $table->string('slug')->unique();

            $table->longText('description')->nullable();

            $table->float('price')->nullable();
            $table->string('currency', 50);
            $table->enum('restricted_age', [0, 1]);
            $table->string('formato', 50)->default('compra');
            $table->enum('allow_rating', [0, 1])->default(1);

            $table->enum('shipping', ['logistic', 'manual']);
            $table->json('shipping_aviable');

            $table->enum('status', [0, 1, 2])->default(0);
            $table->enum('active', [0, 1])->default(0);

            $table->time('created');

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
        Schema::dropIfExists('products');
    }
};
