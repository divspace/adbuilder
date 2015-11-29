<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up() {
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->char('hash_id', 36)->unique();
			$table->integer('brand_id')->unsigned();
			$table->integer('manufacturer_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->string('name', 255);
			$table->char('upc', 14)->unique();
			$table->text('description');
			$table->text('marketing_description');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('products');
	}
}
