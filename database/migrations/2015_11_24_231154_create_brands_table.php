<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandsTable extends Migration {

	public function up() {
		Schema::create('brands', function(Blueprint $table) {
			$table->increments('id');
			$table->char('hash_id', 36)->unique();
			$table->string('name', 255);
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('brands');
	}
}
