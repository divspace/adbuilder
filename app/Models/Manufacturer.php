<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model {

    public $timestamps = true;

    protected $table = 'manufacturers';

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'hash_id',
        'name'
    ];

}
