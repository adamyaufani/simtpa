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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            #Identitas Lembaga
            $table->string('institution_name')->nullable();
            $table->string('nspq_number')->nullable();
            $table->string('supervisory_institution_name')->nullable();
            $table->string('years_of_establishment')->nullable();

            #Lokasi Lembaga
            $table->string('address')->nullable();
            $table->string('village')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('gmap_address')->nullable();

            #Perijinan
            $table->string('sk_number')->nullable();
            $table->date('sk_number_starting_date')->nullable();
            $table->date('sk_number_ending_date')->nullable();
            $table->text('sk_file')->nullable();

            $table->timestamps();
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
