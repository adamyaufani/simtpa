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
        Schema::create('quota_per_org', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quota')->nullable();
            $table->unsignedBigInteger('training_id')->nullable();
        });

        Schema::table('quota_per_org', function (Blueprint $table) {
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quota_per_org');
    }
};
