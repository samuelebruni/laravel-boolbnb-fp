@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="container mt-5">
        <h1>{{$apartment->title}}</h1>
        <div class="mb-5">
            <i class="fa-solid fa-location-dot text-danger me-2"></i><span>Address:</span>
            <span> {{ $apartment->address }}</span>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="image">
                    <img src="{{ asset('/storage/'. $apartment->cover_image) }}" class="img-fluid" id="cover_image_preview">
                </div>
            </div>
            <div class="col-12">
                <h2>Sponsorizza la tua casa</h2>  
                <h5>Scegli la tua promozione</h5> 
                <div class="card-deck d-flex gap-3 justify-content-around text-center">
                    @foreach ($sponsorships as $sponsorship)
                        <div class="card col-lg-4 mt-4 mb-5 border border-primary text-primary pt-3 pb-3">
                            @csrf
                            <h2 class="card-title">{{$sponsorship->name}}</h2>
                            <h2 class="card-title">€ {{$sponsorship->price}}</h2>
                            <hr>
                            <h5 class="card-title">Sponsorizza il tuo appartamento per {{$sponsorship->duration}} ore!</h5>
                            <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                            <input type="hidden" name="price" value="{{$sponsorship->price}}">
                            <input type="hidden" name="sponsorship_id" value="{{$sponsorship->id}}">
                            <button type="button" class="btn pink" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}" data-sponsorship-id="{{ $sponsorship->id }}">
                                Go to Checkout
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{$apartment->id}}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="dropin-container"></div>
                        <form action="{{route('admin.sponsorship.transation', $apartment->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="sponsorship_id" id="sponsorship_id" value="">
                            <button id="submit-button" class="button button--small button--green">Purchase</button>
                        </form>                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var buttons = document.querySelectorAll('.btn.pink');

    buttons.forEach(function(button) {
        button.addEventListener('click', function () {
            var sponsorshipId = this.getAttribute('data-sponsorship-id');
            document.getElementById('sponsorship_id').value = sponsorshipId;

            var dropinContainer = document.getElementById('dropin-container');

            braintree.dropin.create({
                authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
                selector: '#' + dropinContainer.id
            }, function (err, instance) {
                instance.requestPaymentMethod(function (err, payload) {
                    axios.post('{{ route("admin.sponsorship.transation", $apartment->id) }}', {
                        nonce: payload.nonce,
                        sponsorship_id: sponsorshipId
                    })
                    .then(function (response) {
                        window.location.href = 'admin/apartments/index';
                    })
                    .catch(function (error) {
                        console.error('Payment failed:', error);
                    });
                });
            });
        });
    });
</script>

<style>
    .button {
        cursor: pointer;
        font-weight: 500;
        left: 3px;
        line-height: inherit;
        position: relative;
        text-decoration: none;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        border-radius: 3px;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
    }

    .button--small {
        padding: 10px 20px;
        font-size: 0.875rem;
    }

    .button--green {
        outline: none;
        background-color: red;
        border-color: red;
        color: white;
        transition: all 200ms ease;
    }

    .button--green:hover {
        background-color: white;
        color: black;
    }
</style>

@endsection
