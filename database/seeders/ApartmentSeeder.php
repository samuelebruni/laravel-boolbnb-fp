<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Faker\Generator as Faker;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 6; $i++){
            $apartment = new Apartment();
            $apartment->name = $faker->realText(50);
            $apartment->latitude = $faker->realText(50);
            $apartment->longitude = $faker->realText(50);
            $apartment->description = $faker->realText(200);
            $apartment->cover_image = $faker->imageUrl(640, 480, 'animals', true);
            $apartment->bedrooms = $faker->randomDigitNot(0);
            $apartment->bathrooms = $faker->randomDigitNot(0);
            $apartment->rooms = $faker->randomDigitNot(0);
            $apartment->beds = $faker->randomDigitNot(0);
            $apartment->mq = $faker->randomDigitNot(0);
            $apartment->max_guests = $faker->randomDigitNot(0);;
            $apartment->smokers = $faker->boolean();
            $apartment->visible = $faker->boolean();
            $apartment->save();
        }

    }
}
