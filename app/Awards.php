<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Awards extends Model {

    protected $table = 'awards';

    protected $primaryKey = 'awardsId';

    public $timestamps = false;

}