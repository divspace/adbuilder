<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up() {
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('image_type_id')->unsigned();
			$table->string('view', 15);
			$table->string('description', 32);
			$table->string('url', 255);
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('images');
	}
}
