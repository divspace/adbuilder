<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

	public $timestamps = true;

    protected $table = 'brands';

	protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'hash_id',
        'name'
    ];

}
