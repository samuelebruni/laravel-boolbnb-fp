<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SponsorshipController extends Controller
{
    public function index(Apartment $apartment)
    {
        $user_id = Auth::user()->id;
        if ($user_id !== $apartment->user_id) {
            return redirect()->route('admin.apartments.index')->with('message', 'You do not have permission to proceed 📛');
        }
        $sponsorships = Sponsorship::all();
        return view('admin.sponsorships.index', compact('apartment', 'sponsorships'));
    }

    public function store(Apartment $apartment, Sponsorship $sponsorship)
    {
        //Controllo se l'utente autenticato è il proprietario dell'appartamento
        if ($apartment->user_id === Auth::id()) {

            // Verifica se l'appartamento ha già una sponsorizzazione in corso
            $existingSponsorship = $apartment->sponsorships()
                ->where('expired_sponsorship', '>', now())
                ->first();

            if ($existingSponsorship) {
                // Appartamento ha già una sponsorizzazione attiva
                return redirect()->route('admin.apartments.index')->with('message', 'Apartment already has an active sponsorship 📛');
            }

            //Creazione di un oggetto Carbon rappresentante l'istante attuale
            $expired_sponsorship = Carbon::now();

            //Elaborazione della Durata della sponsorizzazione
            $time = explode(':', $sponsorship->duration);
            //Estrazione di ore,minuti e secondi dalla durata
            $hours = (int)$time[0];
            $minutes = (int)$time[1];
            $seconds = (int)$time[2];

            //Aggiunta della Durata alla data di scadenza
            if ($hours) {
                $expired_sponsorship->addHours($hours);
            }
            if ($minutes) {
                $expired_sponsorship->addMinutes($minutes);
            }
            if ($seconds) {
                $expired_sponsorship->addSeconds($seconds);
            }

            $apartment->sponsorships()->attach([
                $sponsorship->id => ['expired_sponsorship' => $expired_sponsorship, 
                'start_sponsorship' => now()]
            ]);
            return to_route('admin.apartments.index')->with('message', 'The sponsorship went well🚀');
        } else {
            //Errore 403 se l'utente non è il proprietario dell'appartamento
            abort('403', 'You do not have permission to proceed 📛');
        }
    }
}