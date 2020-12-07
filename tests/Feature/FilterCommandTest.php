<?php

namespace Zarate\Filterable\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Zarate\Filterable\Tests\TestCase;

class FilterCommandTest extends TestCase
{
    /** @test */
    public function it_creates_a_new_filter_class()
    {
        $filterClass = app_path('Filters/MyFilter.php');

        if (File::exists($filterClass)) {
            unlink($filterClass);
        }

        $this->assertFalse(File::exists($filterClass));

        Artisan::call('make:filter MyFilter');

        $this->assertTrue(File::exists($filterClass));
    }
}