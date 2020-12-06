<?php

namespace Zarate\Tests;

use Orchestra\Testbench\TestCase;

class FilterableTest extends TestCase
{
    public function test_can_filter()
    {
        $this->withoutExceptionHandling();
        $john = User::create(['name' => 'john']);
        $ellie = User::create(['name' => 'ellie']);

        $response = $this->get('users/q=john');
        $response->assertCollectionView('users')
            ->contains($john)
            ->noContains($ellie);
    }
}