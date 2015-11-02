<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Regulation extends Model {

    protected $table = 'regulation';

    protected $primaryKey = 'regulationId';

    public $timestamps = false;

}