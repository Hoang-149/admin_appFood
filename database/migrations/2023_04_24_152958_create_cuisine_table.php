<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuisineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuisine', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category_id');
            $table->string('user_id');
            $table->string('image')->nullable();
            $table->integer('duration')->nullable();
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('category')->onDelete('CASCADE')
            //     ->onUpdate('CASCADE');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')
            //     ->onUpdate('CASCADE');
            $table->string('difficulty')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('steps')->nullable();
            $table->string('websiteURL')->nullable();
            $table->string('youtubeURL')->nullable();
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('cuisine');
    }
}
