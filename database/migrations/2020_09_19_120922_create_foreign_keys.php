<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('reveals', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('reservations', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('details', function(Blueprint $table) {
			$table->foreign('reveal_id')->references('id')->on('reveals')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

	
	}

	public function down()
	{
		Schema::table('reveals', function(Blueprint $table) {
			$table->dropForeign('reveals_patient_id_foreign');
		});

		Schema::table('reservations', function(Blueprint $table) {
			$table->dropForeign('reservations_patient_id_foreign');
		});

		Schema::table('details', function(Blueprint $table) {
			$table->dropForeign('details_reveal_id_foreign');
		});

	}

	
	
}