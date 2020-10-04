<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRevealsTable extends Migration {

	public function up()
	{
		Schema::create('reveals', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('patient_id')->unsigned()->nullable();
			// $table->string('patient_name', 255)->nullable();
			$table->string('phone', 255)->nullable();
			$table->enum('status', array('new', 'old'));
			$table->timestamp('detection_date')->now();
			$table->float('fees')->default(0);
			$table->float('fees_other')->default(0);
			$table->tinyInteger('is_finished')->default(0);
			$table->integer('reveal_num');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reveals');
	}
}