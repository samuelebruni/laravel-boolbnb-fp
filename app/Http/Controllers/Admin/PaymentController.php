<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Apartment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => '10.00', // Imposta l'importo dell'importo da addebitare
            'paymentMethodNonce' => $request->input('paymentMethodNonce'),
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');
            $price = $request->input('price');
            $apartment_id = $request->input('apartment_id');
            $sponsorship_id = 0;
            if ($price > 5.99) {
                $sponsorship_id = 3;
            } elseif ($price < 5.99) {
                $sponsorship_id = 1;
            } else {
                $sponsorship_id = 2;
            }

            $gateway->transaction()->sale([
                'amount' => $price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => true,
                ],
            ]);

            $apartment = Apartment::find($apartment_id);
            $apartment->sponsorships()->attach($sponsorship_id);
            return view('admin.apartments.show');
        } else {
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.apartments.show', ['token' => $clientToken]);
        }
    }
}
