<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = [
            [
                "name" => 'Bronze',
                "price" => 2.99,
                "duration" => '24:00'
            ],
            [
                "name" => 'Silver',
                "price" => 5.99,
                "duration" => "72:00"
            ],
            [
                "name" => 'Gold',
                "price" => 9.99,
                "duration" => "144:00"
            ],
        ];

        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->duration = $sponsorship['duration'];
            $newSponsorship->save();
        }
    }
}
