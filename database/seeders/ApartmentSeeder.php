<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



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
            $apartment->slug = Str::slug($apartment->name, '-');
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
            $apartment->visible = $faker->boolean();
            $apartment->save();
        }
        /* DB::table('apartments')->insert([
            
            'name' => 'Villa il sogno',
            'slug' => 'Villa-il-sogno',
            'latitude' => '41.954010',
            'longitude' => '12.320982',
            'description' => '',
            'cover_image' => 'apartments_thumbs/villa-cubo/villa_cover.webp',
            'bedrooms' => '3',
            'bathrooms' => '2',
            'rooms' => '4',
            'beds' => '8',
            'mq' => '250',
            'max_guests' => '10',
            'visible' => '1',
            
        ]);
     
        DB::table('apartments')->insert([
            
            'name' => 'Castello Meraviglioso',
            'slug' => 'Castello-Meraviglioso',
            'latitude' => '41.815925',
            'longitude' => '12.664510',
            'description' => 'Godetevi un soggiorno magico in questo meraviglioso castello con piscina che si affaccia sui vigneti di Mornico Losana. Chef incluso! Il Castello di Mornico, risalente al XII secolo, è stato riprogettato in un affascinante maniero privato che offre camere ben arredate, ricche di fascino storico ma con tutti i comfort moderni.',
            'cover_image' => 'apartments_thumbs/castello-meraviglioso/castello_cover.webp',
            'bedrooms' => '14',
            'bathrooms' => '7',
            'rooms' => '10',
            'beds' => '16',
            'mq' => '550',
            'max_guests' => '16',
            'visible' => '1',

        ]);

        DB::table('apartments')->insert([
            
            'name' => 'Casa sul lago',
            'slug' => 'Casa-sul-lago',
            'latitude' => '45.842934',
            'longitude' => '9.104369',
            'description' => 'Villa Front Lake è una residenza di lusso senza pari sul lago di Como. Dotata di design e arredi spettacolari, viste panoramiche e splendidi giardini paesaggistici, questa storica villa con sette camere da letto offre un ambiente incomparabile di privacy e classe, rendendola forse la migliore casa vacanze per riunioni di famiglia o ospiti di matrimoni di destinazione sulle rive esclusive di Como.',
            'cover_image' => 'apartments_thumbs/casa-sul-lago/casa-sul-lago_cover.webp',
            'bedrooms' => '6',
            'bathrooms' => '2',
            'rooms' => '4',
            'beds' => '8',
            'mq' => '150',
            'max_guests' => '8',
            'visible' => '1',

        ]); */

       
    }
}
