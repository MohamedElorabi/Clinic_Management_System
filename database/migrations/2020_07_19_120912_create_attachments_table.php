<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentsTable extends Migration {

	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('ref_id');
			$table->string('ref_type');
			$table->string('value');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('attachments');
	}
}