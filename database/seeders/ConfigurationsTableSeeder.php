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
                'field_type' => 'select'
            ],
            [
                'name' => 'current_term',
                'value' => 1,
                'field_type' => 'select'
            ]
        ]);
    }
}
