<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 15, 2);
            $table->decimal('reward_point', 15, 2);
            $table->text('description');
            $table->string('shipping_address');
            $table->string('image');
            $table->integer('status')->default(0);
            // $table->integer('request_user_id');
            // $table->integer('sponsor_by');
            $table->foreignId('sponsored_by')->references('id')->on('sponsors');
            $table->string('created_by')->nullable();
            $table->string('edited_by')->nullable();

            // $table->foreign('request_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('sponsor_items');
    }
}
