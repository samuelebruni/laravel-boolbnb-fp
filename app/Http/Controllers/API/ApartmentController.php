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
    public function index(Request $request)
    {
        $q = Apartment::with('services', 'images', 'sponsorships')->where('visible', '=', 1);
        if ($request) {
            if ($request->selected_services) {
                $services = $request->selected_services;
                $q->whereHas('services', function ($q) use ($services) {
                    $q->whereIn('id', $services);
                });
            }
            if ($request->selected_bedrooms) {
                $bedrooms = $request->selected_bedrooms;
                if (in_array('other', $bedrooms)) {
                    $q->where('bedrooms', '>', 5)
                        ->orWhereIn('bedrooms', $bedrooms);
                } else {
                    $q->whereIn('bedrooms', $bedrooms);
                }
            }
            if ($request->selected_rooms) {
                $rooms = $request->selected_rooms;
                if (in_array('other', $rooms)) {
                    $q->where('rooms', '>', 5)
                        ->orWhereIn('rooms', $rooms);
                } else {
                    $q->whereIn('rooms', $rooms);
                }
            }
            if ($request->selected_beds) {
                $beds = $request->selected_beds;
                if (in_array('other', $beds)) {
                    $q->where('beds', '>', 5)
                        ->orWhereIn('beds', $beds);
                } else {
                    $q->whereIn('beds', $beds);
                }
            }
            if ($request->selected_max_guests) {
                $max_guests = $request->selected_max_guests;
                if (in_array('other', $max_guests)) {
                    $q->where('max_guests', '>', 5)
                        ->orWhereIn('max_guests', $max_guests);
                } else {
                    $q->whereIn('max_guests', $max_guests);
                }
            }
            if ($request->selected_bathrooms) {
                $bathrooms = $request->selected_bathrooms;
                if (in_array('other', $bathrooms)) {
                    $q->where('bathrooms', '>', 5)
                        ->orWhereIn('bathrooms', $bathrooms);
                } else {
                    $q->whereIn('bathrooms', $bathrooms);
                }
            }
        }
        $apartments = $q->get();
        return response()->json([
            'success' => true,
            'result' => $apartments
        ]);
    }

    public function getApartmentById($id)
    {
        $apartment = Apartment::with('services', 'images')->find($id);
        return response()->json([
            'success' => true,
            'result' => $apartment
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
