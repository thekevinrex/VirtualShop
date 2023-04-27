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
        Schema::create('sellers', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('name');
            $table->longText('abaut_me')->nullable();

            $table->string('telephone')->unique()->nullable();
            $table->string('telegram')->unique()->nullable();


            $table->string('plan');
            $table->timestamp('plan_verified_at')->nullable();
            $table->time('plan_expire_in')->nullable();
            $table->unsignedBigInteger('plan_transaction_id')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('payment_method')->nullable();
            $table->string('payment_option')->nullable();

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
        Schema::dropIfExists('sellers');
    }
};
