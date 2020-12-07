<?php

namespace Zarate\Tests;

use Illuminate\Support\Facades\Hash;
use Zarate\Tests\Models\User;

class FilterableTest extends TestCase
{
    public function test_can_filter_users()
    {
        User::create($this->attributes(['name' => 'jonathan']));
        User::create($this->attributes(['name' => 'ellie']));

        $this->get('users?name=jonathan')
            ->assertJsonFragment([
                [
                    'id' => 1,
                    'name' => 'jonathan',
                ]
            ])
            ->assertJsonMissing([
                [
                    'id' => 2,
                    'name' => 'ellie',
                ]
            ]);
    }

    protected function attributes(array $overrides = [])
    {
        return array_merge([
            'name' => 'User Test',
            'email' => "{$overrides['name']}@test.com",
            'password' => Hash::make('password'),
        ], $overrides);
    }
}