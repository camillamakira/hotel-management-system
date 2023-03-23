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
            'history' => 'Golf Hotel was built in 2020 during the Covid-19 period, this hotel is located in the center of   Kakamega town in Kenya, with easy access to the couty;stourist attractions. It offers tastefully decorated rooms, delicious meals and great services'
        ]);
    }
}
