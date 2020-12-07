<?php

namespace Zarate\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Zarate\Filterable;

class User extends Model
{
    use Filterable;

    protected $table = 'users';

    protected $guarded = [];
}