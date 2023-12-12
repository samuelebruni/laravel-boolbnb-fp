<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = ['Wi-Fi', 'Pool', 'Sauna', 'Fenced Parking', 'Private Parking', 'Kitchen', 'Private Bathroom', 'Shared Bathroom', 'Hair dryer', 'Tumble dryer', 'Air Conditioning', 'Iron', 'Fireplace', 'Barbecue', 'Gymnasium', 'Cradle', 'Electric Vehicle Charging Station', 'Whirlpool', 'Fire Alarm', 'Carbon Monoxide Detector', 'Washing machine', 'TV', 'Shower', 'Bathtub'];

        foreach ($services as $service){
            $newService = new Service();
            $newService->name = $service;
            $newService->save();
        }
    }
}
