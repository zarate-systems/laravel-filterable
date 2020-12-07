<?php

namespace Zarate\Filterable;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Filter a result set.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Zarate\Filterable\QueryFilters  $filters
     * @param  array  $defaults
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, QueryFilters $filters, $defaults = [])
    {
        return $filters->apply($query, $defaults);
    }
}
