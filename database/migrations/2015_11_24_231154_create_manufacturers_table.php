<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManufacturersTable extends Migration {

	public function up() {
		Schema::create('manufacturers', function(Blueprint $table) {
			$table->increments('id');
			$table->char('hash_id', 36)->unique();
			$table->string('name', 255);
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('manufacturers');
	}
}
