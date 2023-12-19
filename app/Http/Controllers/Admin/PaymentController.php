<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Apartment $apartment, Sponsorship $sponsorship)
    {
        // Verifica se l'utente autenticato è il proprietario dell'appartamento
        if ($apartment->user_id === Auth::id()) {
            
            /*
            🚨 ALERT: Se dovessi riportare i dati presenti e precedentemente inseriti nel mio .env, essi avranno come valore 'NULL', per riuscire a dare il valore di cui necessito ai campi, sono stato costretto a digitari rendendoli prelevabili a terzi. 
            
            */

            /*
            dd([
                'environment' => env('BRAINTREE_ENVIRONMENT'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY')
            ]);
            */
             
            
            /*
            Il risultato sarà 'NULL' ☝ 
            */
            
            
            // Inizializzazione del gateway Braintree con le credenziali di prova
            $gateway = new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'y9dkqzzc466ggcw9',
                'publicKey' => 'txsy74sz422g93m8',
                'privateKey' => '93eb9a243f8645e1a57977389437787f'
            ]);

            // Generazione del client token per l'integrazione di Braintree
            $clientToken = $gateway->clientToken()->generate();

            // Ritorna la vista con il token del cliente e le informazioni sulla sponsorizzazione e sull'appartamento
            return view('admin.sponsorships.payment.index', [
                'client_token' => $clientToken,
                'sponsorship' => $sponsorship,
                'apartment' => $apartment
            ]);
        } else {
            // Errore 403 se l'utente non è il proprietario dell'appartamento
            abort('403', 'You do not have permission to proceed 📛');
        }
    }

    public function process(Request $request, Apartment $apartment, Sponsorship $sponsorship)
    {
        // Inizializzazione del gateway Braintree con le credenziali di prova
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'y9dkqzzc466ggcw9',
            'publicKey' => 'txsy74sz422g93m8',
            'privateKey' => '93eb9a243f8645e1a57977389437787f'
        ]);

        // Ottenimento del nonce dal pagamento del frontend
        $nonce = $request->input('payment_method_nonce');

        // Esecuzione della transazione di pagamento con Braintree
        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        // Verifica se la transazione ha avuto successo
        if (!$result->success) {
            // Se la transazione non ha avuto successo, reindirizza all'elenco degli appartamenti con un messaggio di errore
            return redirect()->route('admin.apartments.index')->with('message', "Payment failed ❌");
        } 

        // Se la transazione ha avuto successo, reindirizza alla funzione store del controller SponsorshipController
        return redirect()->route('admin.sponsorships.store', [
            'apartment' => $apartment,
            'sponsorship' => $sponsorship
        ]);
    }
}
