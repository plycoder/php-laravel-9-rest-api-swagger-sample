<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->string('name');
			$table->date('dob');
			$table->string('phone');
			$table->string('email');
			$table->string('degrees');
			$table->string('services');
			$table->string('job_position');
			$table->string('address');
			$table->longText('detail');
			$table->string('post_code');
			$table->string('geo_location');
			$table->string('country_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
