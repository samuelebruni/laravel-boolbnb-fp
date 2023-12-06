<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;

class DashboardController extends Controller
{
    public function index()
    {
    
        $allApartments = Apartment::all()->count();
    
        return view('admin.index', compact('allApartments'));
    }
}