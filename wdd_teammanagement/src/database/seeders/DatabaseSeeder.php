<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use wdd\teammanagement\Models\Admin;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Admin::factory()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('abdallah'),
        ]);
    }
}