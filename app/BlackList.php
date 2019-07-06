<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    public $timestamps = false;
    protected $table="blacklist";
    protected $primarykey="id";
}
