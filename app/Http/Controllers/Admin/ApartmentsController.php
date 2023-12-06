<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if (!is_null($apartment->cover_image)) {
            Storage::delete($apartment->cover_image);
        }

        $apartment->sevices()->detach();

        $apartment->delete();
        
        return to_route('admin.apartments.index')->with('messagge', 'Cancellazione avvenuta con successo 💥');
    }

    /* public function recycle() {
        $trashed = Apartment::onlyTrashed()->orderByDesc('id')->paginate(6);
        return to_route('admin.apartments.trashed');
    } */

    /* public function restore($id) {
        $apartment = Apartment::onlyTrashed()->find($id);

        if($apartment) {
            $apartment->restore();
            return redirect()->route('apartment.recycle')->with('recycle_mess', 'The project was restored ♻');
        }
    } */
}
