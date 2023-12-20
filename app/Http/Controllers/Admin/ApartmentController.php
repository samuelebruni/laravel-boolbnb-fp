<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    public function index()
    {
        // Ottieni gli appartamenti dell'utente autenticato
        $apartments = Apartment::where('user_id', Auth::id())->get();

        // Passa i dati alla vista
        return view('admin.apartments.index', compact('apartments'));
    }

    public function create()
    {
        // Ottieni tutti i servizi
        $services = Service::all();

        // Mostra il form di creazione con i servizi disponibili
        return view('admin.apartments.create', compact('services'))->with('message', 'Creation was successful 💚🎉');
    }

    public function store(StoreApartmentRequest $request)
    {
        // Validazione dei dati
        $validatedData = $request->validated();

        // Genera uno slug dall'input del nome
        $validatedData['slug'] = Str::slug($request->name, '-');

        // Gestione dell'immagine di copertina
        if ($request->has('cover_image')) {
            $file_path = Storage::put('apartments_thumbs', $request->cover_image);
            $validatedData['cover_image'] = $file_path;
        }

        // Aggiungi l'ID dell'utente autenticato
        $validatedData['user_id'] = Auth::id();

        // Creazione dell'appartamento
        $apartment = Apartment::create($validatedData);

        // Aggiungi le immagini associate all'appartamento
        if ($images = $request->images) {
            foreach ($images as $image) {
                $path = Storage::put('apartments_thumbs', $image);
                Image::create(['apartment_id' => $apartment->id,'path' => $path,]);
            }
        }

        // Aggiungi i servizi associati all'appartamento
        $apartment->services()->attach($request->services);

        return redirect()->route('admin.apartments.index', $apartment);
    }

    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    public function edit(Apartment $apartment)
    {
        // Ottieni tutti i servizi
        $services = Service::all();

        return view('admin.apartments.edit', compact('apartment', 'services'));
    }

    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        // Validazione dei dati
        $validatedData = $request->validated();

        // Gestione dell'immagine di copertina
        if ($request->has('cover_image')) {
            $path = Storage::put('apartments_thumbs', $request->cover_image);
            $validatedData['cover_image'] = $path;
        }

        // Genera uno slug se il nome è stato modificato
        if (!Str::is($apartment->getOriginal('name'), $request->name)) {
            $validatedData['slug'] = $apartment->generateSlug($request->name);
        }

        // Aggiorna i servizi associati all'appartamento
        if ($request->has('services')) {
            $apartment->services()->sync($validatedData['services']);
        }

        // Aggiungi le immagini associate all'appartamento
        if ($images = $request->images) {
            foreach ($images as $image) {
                $multiplePath = Storage::put('apartments_thumbs', $image);
                Image::create(['apartment_id' => $apartment->id, 'path' => $multiplePath]);
            }
        }

        // Aggiorna l'appartamento con i dati validati
        $apartment->update($validatedData);

        return redirect()->route('admin.apartments.index')->with('message', 'Successful editing 🛠');
    }

    public function destroy(Apartment $apartment)
    {
        // Verifica se l'appartamento appartiene all'utente autenticato
        if ($apartment->user_id === Auth::id()) {
            // Elimina l'immagine di copertina se presente
            if (!is_null($apartment->cover_image)) {
                Storage::delete($apartment->cover_image);
            }

            // Elimina tutte le immagini associate all'appartamento
            foreach ($apartment->images as $image) {
                Storage::delete($image->path);
            }

            // Rimuovi i servizi associati all'appartamento
            $apartment->services()->detach();

             // Rimuovi la sponsorizzazione associata all'appartamento
             $apartment->sponsorships()->detach();

            // Elimina tutte le immagini associate all'appartamento
            $apartment->images()->delete();

            // Elimina l'appartamento
            $apartment->delete();

            // Reindirizza alla vista degli appartamenti con un messaggio di successo
            return redirect()->route('admin.apartments.index')->with('message', 'Successful deletion 💥');
        }

        // Se l'appartamento non appartiene all'utente autenticato, restituisci un errore 403
        abort(403, "You cannot delete this apartment 📛 it's not yours");
    }
}
