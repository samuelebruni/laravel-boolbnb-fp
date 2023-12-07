<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Apartment::with('services')->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        //
    }

}
