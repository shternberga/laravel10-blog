<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'MedComedy', 'description' => 'Where medicine meets humor.'],
            ['name' => 'Brainy', 'description' => 'Insights and curious facts in medicine.'],
            ['name' => 'HealthFun', 'description' => 'Fun aspects of health and wellness.'],
            ['name' => 'DocHumor', 'description' => 'A lighter take on medical professionals.'],
            ['name' => 'PharmaJoke', 'description' => 'The funny side of pharmacy.']
        ]);
    }
}
