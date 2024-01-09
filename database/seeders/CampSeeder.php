<?php

namespace Database\Seeders;

use App\Models\Camp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $camps = [
            [
                'title' => 'Dev Handal',
                'slug' => 'dev-handal',
                'price' => 280,
            ],
            [
                'title' => 'Dev Newbie',
                'slug' => 'dev-newbie',
                'price' => 140,
            ],
        ];

        foreach ($camps as $camp) {
            Camp::create($camp);
        }
    }
}
