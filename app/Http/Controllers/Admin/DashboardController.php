<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Conta tutti gli appartamenti dell'utente autenticato
        $allApartments = Apartment::where('user_id', Auth::id())->count();

        // Conta tutti i lead associati agli appartamenti dell'utente autenticato
        $allLeads = Lead::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        // Conta tutte le transazioni (appartamenti con sponsorizzazioni) dell'utente autenticato
        $allTransations = Apartment::whereHas('sponsorships', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        return view('admin.index', compact('allApartments', 'allLeads', 'allTransations'));
    }
}
