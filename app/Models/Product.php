<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    public $timestamps = true;

    protected $table = 'products';

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'hash_id',
        'brand_id',
        'manufacturer_id',
        'category_id',
        'name',
        'upc',
        'description',
        'marketing_description'
    ];

    public function brand() {
        return $this->hasOne('App\Model\Brand');
    }

    public function manufacturer() {
        return $this->hasOne('App\Model\Manufacturer');
    }

    public function category() {
        return $this->hasOne('App\Model\Category');
    }

}
