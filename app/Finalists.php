<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Finalists extends Model {

    protected $table = 'finalists';

    protected $primaryKey = 'finalistsId';

    public $timestamps = false;

}