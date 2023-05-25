<?php

namespace Tests\Feature\Commands;

use Illuminate\Support\Facades\Storage;
use Tests\Helpers\FileCreator;
use Tests\TestCase;

/**
 * Class InsertPersonsTest
 * @package Tests\Feature\Commands
 * @see
 */
class InsertPersonsTest extends TestCase
{

    /**
     * @test
     * @dataProvider \Tests\DataProviders\PersonProvider::persons
     */
    public function test_console_command($data, $expected): void
    {
        $fileCreator = new FileCreator();
        $filename = $fileCreator->createCSV([$data]);

        Storage::fake();
        $csvString = implode(',', $data);

        Storage::put("csv/test.csv", "homeowner,\n" . $csvString);

        $this->artisan('app:insert-persons')
            ->expectsQuestion("Select a file", 0)
            ->expectsOutput(print_r($expected, true));

    }
}

