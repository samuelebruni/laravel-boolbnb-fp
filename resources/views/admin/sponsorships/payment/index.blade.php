@extends('layouts.admin')

@section('content')
    <div class="container">
        <input type="hidden" id="client_token" value="{{ $client_token }}" />
        
        
        <h5 class="text-center mt-5">Complete the payment transaction to proceed 👇</h5>
        
        <form id="payment-form"
            action="{{ route('admin.sponsorships.payment.process', ['apartment' => $apartment->id, 'sponsorship' => $sponsorship->id]) }}"
            method="post" class="d-flex flex-column justify-content-center align-items-center">   
            @csrf

            <div id="dropin-container" class="w-25"></div>

            <input type="submit" id="form_button" class="custom-button custom-button-pink" value="Purchase"/>

            <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </form>
    </div>

    {{-- Scrip per inizializzare Braintree Drop-in --}}
    <script>
        const form = document.querySelector('#payment-form');
        braintree.dropin.create({
            authorization: document.querySelector('#client_token').value,
            container: document.querySelector('#dropin-container'),
        }, (error, dropinInstance) => {
            if (error) console.error(error);

            // Aggiunta dell'evento che si scatenerà all'invio del form
            form.addEventListener('submit', event => {
                event.preventDefault();
                dropinInstance.requestPaymentMethod((error, payload) => {
                    if (error) console.error(error);

                    // Impostazione del nonce e invio del form
                    document.querySelector('#nonce').value = payload.nonce;
                    document.querySelector('#form_button').style.display = 'none';
                    form.submit();
                });
            });
        });
    </script>

    <style>
        .custom-button {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .custom-button-pink {
            background-color: #ff385c;
            color: white;
            border: 2px solid #ff385c;
        }

        .custom-button:hover {
            background-color: white;
            color: #ff385c;
            border: 2px solid #ff385c;
        }
    </style>    
@endsection
