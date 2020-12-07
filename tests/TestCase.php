<?php

namespace Zarate\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;
use Zarate\Tests\Filters\UserFilter;
use Zarate\Tests\Models\User;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations(['--database' => 'sqlite']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
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