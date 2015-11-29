<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model {

    public $timestamps = true;

    protected $table = 'image_types';

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'name'
    ];

    public function image() {
        return $this->belongsTo('App\Model\Image');
    }

}
