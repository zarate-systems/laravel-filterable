<?php

namespace Zarate\Tests;

use Illuminate\Database\Eloquent\Model;
use Zarate\Filterable;

class User extends Model
{
    use Filterable;

    protected $fillable = ['name'];
}