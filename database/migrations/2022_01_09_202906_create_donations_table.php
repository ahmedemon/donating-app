<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->integer('price');
            $table->integer('point');
            $table->integer('category_id');
            $table->text('description');
            $table->string('shipping_address');
            $table->string('images');
            $table->string('used_duration');
            $table->integer('status')->default(0);
            $table->integer('is_paused')->default(1);
            $table->integer('is_purchased')->default(0);
            $table->integer('requested_by')->nullable();
            $table->integer('approved_by')->nullable();
            $table->integer('rejected_by')->nullable();
            $table->integer('recycled_by')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
