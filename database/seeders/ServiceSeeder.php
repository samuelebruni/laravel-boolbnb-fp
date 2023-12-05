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
        $services = ['Wi-Fi', 'Piscina', 'Sauna', 'Parcheggio Recintato', 'Parcheggio Privato', 'Cucina', 'Bagno Privato', 'Bagno in Comune', 'Asciugacapelli', 'Asciugatrice', 'Aria Condizionata', 'Ferro da Stiro', 'Camino', 'Griglia Barbecue', 'Palestra', 'Culla', 'Postazione Ricarica Veicoli Elettici', 'Idromassaggio', 'Allarme Antincendio', 'Rilevatore di Monossido di Carbonio', 'Lavatrice', 'TV', 'Doccia', 'Vasca'];

        foreach ($services as $service){
            $newService = new Service();
            $newService->name = $service;
            $newService->save();
        }
    }
}
