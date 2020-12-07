<?php

namespace Zarate\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Zarate\Filterable;

class Item extends Model
{
    use Filterable;

    protected $fillable = ['name'];

    public $timestamps = false;
}