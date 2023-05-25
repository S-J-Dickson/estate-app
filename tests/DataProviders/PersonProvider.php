<?php

namespace Tests\DataProviders;

class PersonProvider
{

    /**
     * @return array[]
     */
    public static function persons()
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

}
