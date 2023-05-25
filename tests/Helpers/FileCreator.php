<?php

namespace Tests\Helpers;

class FileCreator
{
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
