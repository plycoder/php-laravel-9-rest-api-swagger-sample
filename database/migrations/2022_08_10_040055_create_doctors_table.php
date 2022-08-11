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
			$table->date('dob')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('degrees')->nullable();
			$table->string('services')->nullable();
			$table->string('job_position')->nullable();
			$table->string('address')->nullable();
			$table->longText('detail');
			$table->string('post_code')->nullable();
			$table->string('geo_location')->nullable();
			$table->string('country_code')->nullable();
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
