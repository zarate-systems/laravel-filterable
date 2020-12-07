<?php

namespace Zarate\Filterable\Tests;

use Illuminate\Routing\Router;
use Orchestra\Testbench\TestCase as Orchestra;
use Zarate\Filterable\FilterableServiceProvider;
use Zarate\Filterable\Tests\Filters\UserFilter;
use Zarate\Filterable\Tests\Models\User;

class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations(['--database' => 'sqlite']);
    }

    protected function getPackageProviders($app)
    {
        return [
            FilterableServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /** @var Router $router */
        $router = $app['router'];
        $this->addWebRoutes($router);
    }

    /**
     * @param Router $router
     */
    protected function addWebRoutes(Router $router)
    {
        $router->get('users', [
            'uses' => function (UserFilter $filters) {
                return User::query()->select('id', 'name')
                    ->filter($filters)
                    ->simplePaginate();
            }
        ]);
    }
}