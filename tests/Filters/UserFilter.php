<?php

namespace Zarate\Filterable\Tests\Filters;

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