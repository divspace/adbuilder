<?php

use App\Model\ImageType;
use Illuminate\Database\Seeder;

class ImageTypeSeeder extends Seeder {

    public function run() {
        DB::table('image_types')->delete();

        ImageType::create([
            'image/jpg',
            'image/png',
            'image/tif'
        ]);
    }
}
