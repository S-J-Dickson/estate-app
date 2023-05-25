<?php

namespace Tests\Unit\Services;

use App\Services\PersonService;
use Tests\Helpers\FileCreator;
use Tests\TestCase;

/**
 * Class PersonServiceTest
 * @package Tests\Unit\Services
 * @see \App\Services\PersonService
 */
class PersonServiceTest extends TestCase
{




    /**
     * @test
     * @dataProvider \Tests\DataProviders\PersonProvider::persons
     */
    public function test_can_read_csv($data, $expected)
    {
        $fileCreator = new FileCreator();
        $filename = $fileCreator->createCSV([$data]);

        $file = fopen($filename, 'r');
        $personService = new PersonService();
        $persons = $personService->getPersons($file);

        self::assertEquals($expected, $persons);
    }


}
