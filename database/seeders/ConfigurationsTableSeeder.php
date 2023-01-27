<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::insert([
            [
                'name' => 'current_session',
                'value' => 3,
                'model' => 'App\Models\Session',
                'field_type' => 'select'
            ],
            [
                'name' => 'current_term',
                'value' => 1,
                'model' => 'App\Models\Term',
                'field_type' => 'select'
            ],
            [
                'name' => 'result_view',
                'value' => 'free',
                'seed' => 'card,free,school-fee',
                'field_type' => 'select'
            ]
        ]);
    }
}
