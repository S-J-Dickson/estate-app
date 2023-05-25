<?php

namespace App\Console\Commands;

use App\Services\PersonService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class InsertPersons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-persons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $folder = 'csv'; // Replace with the name of the folder you want to access
        $files = Storage::files($folder);

        $answer  = $this->choice("Select a file", $files);


        $filePath = Storage::path($answer);


        $file = fopen($filePath, 'r');


        $service = new PersonService();

        $persons = $service->getPersons($file);


        $this->line('Array Data:');
        $this->line('-----------');
        $this->line('');

        // Use print_r() or var_dump() to display the array
        $this->line(print_r($persons, true));

    }
}
