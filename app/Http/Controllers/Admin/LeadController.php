<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Apartment;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index(Lead $lead)
    {
        // Ottieni l'utente autenticato
        $user = Auth::user();

        // Ottieni tutti gli appartamenti dell'utente autenticato
        $apartments = Apartment::where('user_id', '=', $user->id)->get();

        // Ottieni tutti i messaggi
        $leads = Lead::all();

        return view('admin.leads.index', compact('leads', 'apartments', 'user'));
    }

    public function destroy(Lead $lead)
    {
        // Elimina il messaggio
        $lead->delete();

        return redirect()->route('admin.leads.index');
    }
}

