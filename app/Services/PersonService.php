<?php

namespace App\Services;


use App\Models\Person;

class PersonService
{


    public function getPersons($file): array
    {
        $persons = [];

        while ($row = fgetcsv($file)) {
            $name = $row[0];

            if ($name === "homeowner") {
                continue;
            }

            if ($this->isMultipleNames($name)) {
                foreach ($this->getMultipleNames($name) as $item) {
                    $persons[] = $this->createPerson($item, $name);
                }
            } else {
                $persons[] = $this->createPerson($row[0]);
            }
        }

        fclose($file);

        return $persons;
    }


    private function createPerson(string $name, string $row = null)
    {
        return $person = [
            "title" => $this->getTitle($name),
            "first_name" => $this->getFirstName($name),
            "initial" => $this->getInitial($name),
            "last_name" => $this->getLastName($name, $row),
        ];
    }


    private function getMultipleNames($row)
    {
        $parts = preg_split('/\s+(?:and|&)\s+/', $row);
        return $parts;
    }


    private function isMultipleNames($row)
    {
        return (strpos($row, '&') !== false || strpos($row, 'and') !== false);
    }


    private function getTitle($name)
    {
        // Split the name into an array of words
        // Split the full name by whitespace
        $nameParts = explode(' ', $name);

        $filteredParts = $this->getFilteredParts($nameParts);

        // Extract the title (assuming it's the first word)
        $title = $filteredParts[0];

        return $title;
    }

    private function getLastName(string $name, ?string $row)
    {
        // Split the full name by whitespace
        $nameParts = explode(' ', $name);

        $filteredParts = $this->getFilteredParts($nameParts);


        //Covers case when creating two people who share same last name
        if (count($filteredParts) === 1) {
            if ($row !== null) {
                $nameParts = explode(' ', $row);
                $filteredParts = $this->getFilteredParts($nameParts);
            }
        }

        // Extract the last name (assuming it's the last part)
        return end($filteredParts);

    }

    /**
     * @param string $name
     * @return string|null
     */
    private function getFirstName(string $name): ?string
    {
        // Split the full name by whitespace
        $nameParts = explode(' ', $name);

        $filteredParts = $this->getFilteredParts($nameParts);

        //No extra names provided
        if (count($filteredParts) < 2) {
            return null;
        }

        //initial provided
        if (strlen($filteredParts[1]) <= 2) {
            return null;
        }

        return $filteredParts[1];
    }

    private function getInitial(string $name): ?string
    {

        $filteredString = str_replace(array('&', 'and'), '', $name);

        // Split the full name by whitespace
        $nameParts = explode(' ', $filteredString);

        $filteredParts = $this->getFilteredParts($nameParts);

        //No extra names provided
        if (count($filteredParts) < 2) {
            return null;
        }

        //name provided
        if (strlen($filteredParts[1]) > 2) {
            return null;
        }

        return $filteredParts[1];
    }

    /**
     * @param array $nameParts
     * @return array
     * @created 25-05-2023 sd@groundwow.com
     */
    public function getFilteredParts(array $nameParts): array
    {
        $filteredParts = array_filter($nameParts, function ($value) {
            return $value !== '';
        });

        return array_values($filteredParts);
    }

}
