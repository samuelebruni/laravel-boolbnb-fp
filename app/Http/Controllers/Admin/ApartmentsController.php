<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;


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
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $validateData = $request->validated();
        if ($request->has('cover_image')) {
            $file_path = Storage::put('apartments_thumbs', $request->cover_image);
            $validateData['cover_image'] = $file_path;
        }
        $apartment = Apartment::create($validateData);
        $apartment->services()->attach($request->services);

        return to_route('admin.apartments.index', $apartment);

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
        $services = Service::all();
        return view('admin.apartments.edit', compact('apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $validateData = $request->validated();

        if ($request->has('cover_image')) {
            $path = Storage::put('apartments_thumbs', $request->cover_image);
            $validateData['cover_image'] = $path;
        } 
        
        if ($request->has('services')) {
            $project->services()->sync($validateData['services']);
        }

        $apartment->update($validateData);
        return to_route('admin.apartments.index');
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
