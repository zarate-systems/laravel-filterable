<?php

namespace Zarate;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;

abstract class QueryFilters
{
    /**
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The builder instance.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Create a new QueryFilters instance.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = new Request($request->input());
    }

    /**
     * Apply the filters to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  array  $defaults
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder, $defaults = []): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (! method_exists($this, $name)) {
                continue;
            }

            if (Str::length($value)) {
                $this->$name($value);
            } else {
                $this->name();
            }
        }

        if (! empty($defaults)) {
            $this->applyDefaults($defaults);
        }

        return $this->builder;
    }

    /**
     * Apply default filters to the builder.
     *
     * @param  array  $defaults
     * @return void
     */
    protected function applyDefaults($defaults): void
    {
        foreach ($defaults as $filter => $value) {
            if (! array_key_exists($filter, $this->filters())) {
                $this->$filter($value);
            }
        }
    }

    /**
     * Get all request filters data.
     *
     * @return array
     */
    protected function filters(): array
    {
        $keys = $this->getFilterMethods();

        return $this->request->only($keys);
    }

    /**
     * Get all the available filter methods.
     *
     * @return array
     */
    protected function getFilterMethods(): array
    {
        $class = new ReflectionClass(static::class);

        $methods = array_map(
            fn ($method) => $method->class === $class->getName() ? $method->name : null,
            $class->getMethods(ReflectionMethod::IS_PUBLIC)
        );

        return array_filter($methods);
    }
}
