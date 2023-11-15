<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductJson extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonString = '{"products":[]}';

                $data = json_decode($jsonString, true);

                $newJsonString = json_encode($data);

                file_put_contents('products.json', $newJsonString);
    }
}
