<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageTypesTable extends Migration {

	public function up() {
		Schema::create('image_types', function(Blueprint $table) {
			$table->increments('id');
			$table->char('name', 9);
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('image_types');
	}
}
