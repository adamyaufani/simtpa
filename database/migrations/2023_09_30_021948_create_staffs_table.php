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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->enum('employment_status', ['pns', 'non pns'])->nullable();
            $table->string('civil_registration_number')->nullable();
            $table->enum(
                'last_formal_education',
                [
                    'Tidak memiliki pendidikan formal',
                    'SD/MI/Sederajat',
                    'SMP/MTs/Sederajat',
                    'SMA/MA/Sederajat',
                    'D1',
                    'D2',
                    'D3',
                    'S1/D4',
                    'S2',
                    'S3',
                ]
            )->nullable();
            $table->string('length_of_islamic_education')->nullable();
            $table->string('core_competency')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('pfoto')->nullable();
        });

        Schema::table('staffs', function (Blueprint $table) {
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
        Schema::dropIfExists('staffs');
    }
};
