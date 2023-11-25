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
        Schema::create('event_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_participant_id')->nullable();
            $table->enum('status', ['Hadir', 'Tidak hadir'])->nullable();
            $table->timestamps();
        });

        Schema::table('event_attendances', function (Blueprint $table) {
            $table->foreign('order_participant_id')->references('id')->on('order_participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_attendances');
    }
};
