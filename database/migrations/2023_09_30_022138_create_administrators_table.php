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
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('director')->nullable();
            $table->unsignedBigInteger('vice_director')->nullable();
            $table->unsignedBigInteger('secretary')->nullable();
            $table->unsignedBigInteger('treasurer')->nullable();
        });

        Schema::table('administrators', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('director')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('vice_director')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('secretary')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('treasurer')->references('id')->on('staffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
};
