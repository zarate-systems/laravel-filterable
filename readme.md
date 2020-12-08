# Laravel Filterable
Apply filters to your Eloquent models in Laravel.

## Installation
You can install the package via composer:

```cmd
composer require zaratesystems/laravel-filterable
```

The package will automatically register itself.

## Usage
Add the `Zarate\Filterable\Filterable` trait to your eloquent model.
Filterable add the filter scope to your Eloquent model.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Zarate\Filterable\Filterable;

class User extends Model
{
    use Filterable;
}
```

Create a new filter class. this package add a new command for create filter class in the Filters directory.

```cmd
php artisan make:filter UserFilter
```

Can see a new filter class in Filters Directory.

```php
<?php

namespace App\Filters;

use Zarate\Filterable\QueryFilters;

class UserFilter extends QueryFilters
{
    /**
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name(string $name)
    {
        return $this->builder->where('name', $name);
    }
}
```

Example for apply the filter class in a Controller.

```php
<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserFilter $filters)
    {
        $users = User::filter($filters)->simplePaginate();
        
        return view('users.index', compact('users'));
    }
}
```

Example http request for filter users by name.

```
http://your-aplication.test/users?name=john
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)