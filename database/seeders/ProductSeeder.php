<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $barangData = [];
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
        $barangData[] = [
            'name' => $faker->name(),
            'image' => $faker->imageUrl(),
            'harga'=> $faker->numberBetween($min = 15000, $max = 60000)
        ];
    }
        foreach ($barangData as $barang) {
            Product::insert($barang);
        }
    }
}
