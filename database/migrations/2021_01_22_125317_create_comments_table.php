<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->string('name', 150);
            $table->string('email', 150);
            $table->timestamps();

            $table->bigInteger('marker_id')->unsigned()->default(1);
            $table->foreign('marker_id')->references('id')->on('markers');

            $table->bigInteger('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
