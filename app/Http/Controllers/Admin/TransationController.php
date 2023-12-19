<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;

class TransationController extends Controller
{
    public function index()
    {   
        // Recupera l'utente autenticato
        $user = Auth::user();

        // Recupera tutti i dati dalla tabella pivot many-to-many
        $apartments = $user->apartments()->with('sponsorships')->get();

        // Passa i dati alla vista
        return view('admin.transations.index', compact('apartments'));
    }
}
