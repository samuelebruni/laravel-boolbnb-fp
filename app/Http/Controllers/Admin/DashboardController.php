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
    
        $allApartments = Apartment::where('user_id', Auth::id())->count();
        $allLeads = Lead::whereHas('apartment', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();
        
    
        return view('admin.index', compact('allApartments', 'allLeads'));
    }
}