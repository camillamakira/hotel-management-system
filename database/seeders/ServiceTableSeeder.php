<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'title' => 'Accomodation',
            'description' => 'we have comfortable rooms, washrooms and bathrooms, we have swimming pools and pool tables.',
        ]);

        Service::create([
            'title' => 'Room service',
            'description' => 'we deliver drinks,foods,to our guests rooms at their comfort zones.'
        ]);

        Service::create([
            'title' => 'House keeping',
            'description' => 'we do regular house keeping by daily room cleaning,bed making ans giving fresh towels and linens. ',
        ]);

        Service::create([
            'title' => 'Front desk services',
            'description' => 'For smooth running of our hotel, we greet and welcome our visitors, answer  calls,reserve booking, check-in and check-out our visitors,and handle our customer complaints.',
        ]);

        Service::create([
            'title' => 'Spa',
            'description' => 'To improve your health and well-being, we provide massage therapy, facials ie.skin care, body treatment,manucure and pedicure and yoga and meditation.'
        ]);


        Service::create([
            'title' => 'Conference room',
            'description' => 'The room is large enough. It can host upto 300 people. For meetings and events we offer visual equipment eg screens and projectors,high speed internet,catering,room layout,white board and markers and document scanning and printing.',
        ]);
    }
}
