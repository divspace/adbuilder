<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up() {
		Schema::table('images', function(Blueprint $table) {
			$table->foreign('image_type_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('restrict');
		});
	}

	public function down() {
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('images_image_type_id_foreign');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_brand_id_foreign');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_manufacturer_id_foreign');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_category_id_foreign');
		});
	}
}
