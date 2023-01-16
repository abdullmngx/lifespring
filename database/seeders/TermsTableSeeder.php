<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Term::insert([
            [
                'name' => 'first',
                'order' => '1'
            ],
            [
                'name' => 'second',
                'order' => '2'
            ],
            [
                'name' => 'third',
                'order' => '3'
            ],
        ]);
    }
}
