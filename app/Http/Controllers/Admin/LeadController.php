<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Apartment;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index(Lead $lead) {

        $user = Auth::user();
        $apartments = Apartment::where('user_id', '=', $user->id)->get();

        $leads = Lead::all();

        return view('admin.leads.index', compact('leads', 'apartments', 'user'));
    }
}
