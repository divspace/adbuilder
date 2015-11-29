<?php namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    public $timestamps = true;

    protected $table = 'images';

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'image_type_id',
        'view',
        'description',
        'url'
    ];

    public function type() {
        return $this->hasOne('App\Model\ImageType', 'id', 'image_type_id');
    }

}
