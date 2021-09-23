<?php

namespace Database\Seeders;
use Ramsey\Uuid\Uuid;
use App\Models\Kariawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  
    private $karyawanData = [];
   
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 100; $i++) {
        $karyawanData[] = [
            'id'   =>  Uuid::uuid1(),
            'name' => $faker->name(),
            'pekerjaan' => $faker->jobTitle,
            'created_at' => $faker->dateTime($max = 'now', $timezone = null)
        ];
    }
        foreach ($karyawanData as $karyawan) {
            Kariawan::insert($karyawan);
        }
    }
}
