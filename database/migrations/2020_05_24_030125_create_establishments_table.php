<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->enum('type', ['restaurant', 'marketplace', 'drugstore']);
            $table->string('address');
            $table->integer('number');
            $table->string('phone');
            $table->string('thumbnail');
            $table->string('image');
            $table->decimal('delivery_fee',4,2);
            $table->decimal('minimum_value',4,2);
            $table->smallInteger('delivery_time_min');
            $table->smallInteger('delivery_time_max');
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('establishments');
    }
}
