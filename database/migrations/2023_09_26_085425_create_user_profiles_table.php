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
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();

            #Identitas Lembaga
            $table->string('institution_name')->nullable();
            $table->string('nspq_number')->nullable();
            $table->string('supervisory_institution_name')->nullable();
            $table->string('years_of_establishment')->nullable();

            #Lokasi Lembaga
            $table->string('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('district')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('regency')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('social_media')->nullable();
            $table->string('gmap_address')->nullable();

            #Perijinan
            $table->string('sk_number')->nullable();
            $table->date('sk_number_starting_date')->nullable();
            $table->date('sk_number_ending_date')->nullable();
            $table->text('sk_file')->nullable();
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
