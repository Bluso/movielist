<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movies extends Model
{
    use SoftDeletes;
    //Table Name
    protected $table = 'movies';
    //Primary Key
    public $pk = 'id';
    protected $dates = ['deleted_at'];
}
