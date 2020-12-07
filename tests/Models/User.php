<?php

namespace Zarate\Filterable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Zarate\Filterable\Filterable;

class User extends Model
{
    use Filterable;

    protected $table = 'users';

    protected $guarded = [];
}