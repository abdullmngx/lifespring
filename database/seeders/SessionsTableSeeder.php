<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Session::insert([
            [
                'name' => '2020/2021'
            ],
            [
                'name' => '2021/2022'
            ],
            [
                'name' => '2022/2023'
            ]
        ]);
    }
}
