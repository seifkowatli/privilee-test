<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Spatie\ArrayToXml\ArrayToXml;

class ConvertCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:csv {csv_file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts CSV file to JSON and XML';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
           $csvFile = $this->argument('csv_file');

        if (!file_exists($csvFile)) {
            $this->error('CSV file not found!');
            return 1;
        }

        $csvFileName = pathinfo($csvFile, PATHINFO_FILENAME);
        $jsonFile = $csvFileName . '.json';
        $xmlFile = $csvFileName . '.xml';

        $reader = Reader::createFromPath($csvFile, 'r');
        $reader->setHeaderOffset(0); // If CSV has headers, adjust as needed

        $data = $reader->getRecords();

        $dataArray = iterator_to_array($data);

        // Convert data to JSON
        $json = json_encode($dataArray, JSON_PRETTY_PRINT);
        file_put_contents($jsonFile, $json);


        $xmlData = array_map(function($hotel) {
            return array_map('htmlspecialchars', $hotel);
        }, $dataArray);
        
        $xml = ArrayToXml::convert(['__numeric' => $xmlData]); 
        file_put_contents($xmlFile, $xml);

        $this->info('CSV file converted to JSON  successfully.');
        return 0;
    }
}
