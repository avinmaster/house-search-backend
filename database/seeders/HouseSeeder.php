<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        House::truncate();

        $csvFile = fopen(base_path("database/data/property-data.csv"), "r");

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            House::create([
                "name" => $data['0'],
                "price" => $data['1'],
                "bedrooms" => $data['2'],
                "bathrooms" => $data['3'],
                "storeys" => $data['4'],
                "garages" => $data['5'],
            ]);
        }

        fclose($csvFile);
    }
}
