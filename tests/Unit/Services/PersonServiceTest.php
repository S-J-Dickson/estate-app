<?php

namespace Tests\Unit\Services;

use App\Services\PersonService;
use Tests\TestCase;

/**
 * Class PersonServiceTest
 * @package Tests\Unit\Services
 * @see \App\Services\PersonService
 */
class PersonServiceTest extends TestCase
{


    /**
     * @return array[]
     */
    public function csvDataTypes()
    {
        return [
            "test john smith" => [
                ["Mr John Smith"],
                [
                    [
                        "title" => "Mr",
                        "first_name" => "John",
                        "initial" => null,
                        "last_name" => "Smith",
                    ],
                ]
            ],

            "test Mrs Jane Smith" => [
                ["Mrs Jane Smith"],
                [
                    [
                        "title" => "Mrs",
                        "first_name" => "Jane",
                        "initial" => null,
                        "last_name" => "Smith",
                    ],
                ]
            ],

            "test Mr and Mrs Smith" => [
                ["Mr and Mrs Smith"],
                [
                    [
                        "title" => "Mr",
                        "first_name" => null,
                        "initial" => null,
                        "last_name" => "Smith",
                    ],
                    [
                        "title" => "Mrs",
                        "first_name" => null,
                        "initial" => null,
                        "last_name" => "Smith",
                    ],
                ]
            ],

            "test Mr M Mackie" => [
                ["Mr M Mackie"],
                [
                    [
                        "title" => "Mr",
                        "first_name" => null,
                        "initial" => "M",
                        "last_name" => "Mackie",
                    ],
                ]
            ],


            "test Dr & Mrs Joe Bloggs" => [
                ["Dr & Mrs Joe Bloggs"],
                [
                    [
                        "title" => "Dr",
                        "first_name" => null,
                        "initial" => null,
                        "last_name" => "Bloggs",
                    ],
                    [
                        "title" => "Mrs",
                        "first_name" => "Joe",
                        "initial" => null,
                        "last_name" => "Bloggs",
                    ],
                ]
            ],

        ];
    }


    /**
     * @test
     * @dataProvider csvDataTypes
     */
    public function test_can_read_csv($data, $expected)
    {
        $filename = $this->createCSV([$data]);

        $file = fopen($filename, 'r');
        $personService = new PersonService();
        $persons = $personService->getPersons($file);

        self::assertEquals($expected, $persons);
    }

    public function createCSV($data)
    {
        $tempDir = tempnam(sys_get_temp_dir(), 'laravel');
        unlink($tempDir); // Remove the temporary file
        mkdir($tempDir); // Create the temporary director

        $filename = $tempDir . '/file.csv';

        $handle = fopen($filename, 'w');

        // Write header row
        $header = ['homeowner',];
        fputcsv($handle, $header);

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        return $filename;
    }
}
