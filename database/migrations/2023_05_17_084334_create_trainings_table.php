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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->nullable();
            $table->string('name')->nullable();
            $table->text('image')->nullable();
            $table->text('background_certificate')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('cost', ['paid', 'free'])->nullable();
            $table->bigInteger('price_earlybird')->nullable();
            $table->bigInteger('price_normal')->nullable();
            $table->bigInteger('price_onsite')->nullable();
            $table->date('earlybird_end')->nullable();
            $table->string('place')->nullable();
            $table->enum('type', ['online', 'onsite'])->nullable();
            $table->text('description')->nullable();
            // $table->bigInteger('quota')->nullable();
            $table->enum('gender_requirement', ['laki-laki', 'perempuan', 'laki-laki dan perempuan'])->nullable();
            $table->date('date_of_birth_requirement')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->enum('participant_type', ['staff', 'santri'])->default('santri')->nullable();
            $table->timestamps();
        });

        // Schema::table('trainings', function (Blueprint $table) {
        //     $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
};
