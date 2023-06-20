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
            $table->unsignedBigInteger('by_seller_id')->nullable();
            $table->unsignedBigInteger('listening_id'); // proporciona cate_id, marca, modelo, detail_modelo

            $table->foreign('seller_id')
                ->references('id')
                ->on('sellers')
                ->onDelete('cascade');

            $table->foreign('by_seller_id')
                ->references('id')
                ->on('sellers')
                ->onDelete('set null');

            $table->foreign('listening_id')
                ->references('id')
                ->on('listenings')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();

            $table->float('price')->nullable();
            $table->string('currency', 50);
            $table->boolean('restricted_age');
            $table->string('formato', 50)->default('compra');
            $table->string('ratings');

            $table->enum('shipping', ['logistic', 'manual']);
            $table->json('shipping_aviable');

            // 0 - verificando | 1 - verificado | 2 - need to be updated
            $table->enum('status', [0, 1, 2])->default(0);
            $table->enum('active', [0, 1])->default(1);

            $table->softDeletes();
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
