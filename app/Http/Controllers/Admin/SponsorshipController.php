<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;


class SponsorshipController extends Controller
{
    public function index(Apartment $apartment)
    {
        $user_id = Auth::user()->id;
        if ($user_id !== $apartment->user_id) {
            return redirect()->route('admin.apartments.index');
        }

        

        $sponsorships = Sponsorship::all();
        return view('admin.sponsorships.index', compact('apartment', 'sponsorships'));
    }

    public function show(Apartment $apartment)
    {
        $user_id = Auth::user()->id;
        if ($user_id !== $apartment->user_id) {
            return redirect()->route('admin.apartments.index');
        }

        $sponsorships = Sponsorship::all();
        return view('admin.sponsorships.index', compact('apartment', 'sponsorships'));
    }

    public function transation(Request $request, $id){
        $data = $request->all();
        $apartment = Apartment::find($id);

        $now = date_create();
        $start_date = date_create();

        if(isset($data['sponsorship_id'])) {
            if ($data['sponsorship_id'] == 1) {
                date_add($now, date_interval_create_from_date_string("24 hours"));
                $expiration = date_format($now, 'Y-m-d H:i:s');
            } elseif ($data['sponsorship_id'] == 2) {
                date_add($now, date_interval_create_from_date_string("72 hours"));
                $expiration = date_format($now, 'Y-m-d H:i:s');
            } else {
                date_add($now, date_interval_create_from_date_string("144 hours"));
                $expiration = date_format($now, 'Y-m-d H:i:s');
            }
    
            if ($apartment->sponsorships()->exists(['apartment_id' => $apartment->id])) {
                abort('403', 'Promozione già attiva su questo appartamento');
            } else {
    
                $formatStartDate = date_format($start_date, 'Y-m-d H:i:s');
                $apartment->sponsorships()->attach($data['sponsorship_id'], ['start_sponsorship' => $formatStartDate, 'expired_sponsorship' => $expiration]);
            }
    
    
            $apartment->save();
    
            return to_route('admin.apartments.show', $apartment)->with('message', 'Successful Sponsorship ✅');
        } else {
            // Se la chiave 'sponsorship_id' non è presente, gestisci l'errore o ritorna una risposta appropriata.
            abort(400, 'Chiave "sponsorship_id" mancante nell\'array $data');
        }
    }
}