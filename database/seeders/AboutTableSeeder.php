<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'title' => 'Welcome To Golf Hotel.',
            'history' => 'Built in 1990 during the Belle Epoque period, this hotel is located in the center of Paris, with easy access to the city’s tourist attractions. It offers tastefully decorated rooms.'
        ]);
    }
}
