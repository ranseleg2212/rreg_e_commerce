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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shopping_cart_id')->nullable()->unique()->constrained();
            $table->double('total')->default(0);
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('tel')->nullable();
            $table->string('address')->default("");
            $table->unsignedBigInteger('id_user')->default(0);
            $table->string('status')->default('Registrado');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
};
