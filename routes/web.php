<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\LeadController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/mailable', function () {
    $lead = App\Models\Lead::find(1);

    return new App\Mail\FromLeadEmail($lead);
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('apartments', ApartmentController::class)->parameters([
        'apartments' => 'apartment:slug'
    ]);
    Route::get('/apartments/{apartment}/sponsorship', [SponsorshipController::class, 'index'])->name('sponsorships.index');
    Route::post('/apartments/{apartment}/sponsorship/transation', [SponsorshipController::class, 'transation'])->name('sponsorship.transation');
    Route::resource('leads', LeadController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
