<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration {

	public function up()
	{
		Schema::create('patients', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('patient_code')->unique();
			$table->string('name', 255);
			$table->integer('age')->nullable();
			$table->string('phone',255)->unique();
			$table->string('address', 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('patients');
	}
}