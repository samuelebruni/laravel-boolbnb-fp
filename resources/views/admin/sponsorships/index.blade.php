@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="container mt-5">
        <h1>{{$apartment->title}}</h1>
        
        <div class="row d-flex justify-content-between">
            <div class="col-sm-12 col-lg-5 col-xl-5">
                <h2>{{$apartment->name}}</h2>
                <div class="image">
                    <img src="{{ asset('/storage/'. $apartment->cover_image) }}" class="img-fluid" id="cover_image_preview">
                </div>
                <div class="mt-2 mb-5">
                    <i class="fa-solid fa-location-dot text-danger me-2"></i><span>Address:</span>
                    <span> {{ $apartment->address }}</span>
                </div>
            </div>
            <div class="col-sm-12 col-lg-7 col-xl-6 d-flex flex-column">
                <h2>Sponsorizza la tua casa</h2>  
                <h5>Scegli la tua promozione</h5> 
                <div class="card-deck d-flex gap-3 justify-content-around text-center">
                    {{-- @foreach ($sponsorships as $sponsorship) --}}

                    {{-- Bronze sponsorship --}}
                        <div class="card col-lg-4 mt-4 mb-5 border_color_b pt-3 pb-3">
                            @csrf
                            <h2 class="card-title bronze">{{$sponsorships[0]['name']}}</h2>
                            <h2 class="card-title">€ {{$sponsorships[0]['price']}}{{-- {{$sponsorship->price}} --}}</h2>
                            <hr class="border_color_b">
                            <p class="card-title #ff385c">Sponsorizza il tuo appartamento per {{$sponsorships[0]['duration']}}{{-- {{$sponsorship->duration}} --}} ore!</p>
                            <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                            <input type="hidden" name="price" value="{{$sponsorships[0]['price']}}{{-- {{$sponsorship->price}} --}}">
                            <input type="hidden" name="sponsorship_id" value="{{$sponsorships[0]['id']}}{{-- {{$sponsorship->id}} --}}">
                            <button type="button" class="btn pink_b" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}" data-sponsorship-id="{{$sponsorships[0]['id']}}{{-- {{ $sponsorship->id }} --}}">
                                Go to Checkout
                            </button>
                        </div>

                        {{-- Silver sponsorship --}}
                        <div class="card col-lg-4 mt-4 mb-5 border_color_s pt-3 pb-3">
                            @csrf
                            <h2 class="card-title silver">{{$sponsorships[1]['name']}}</h2>
                            <h2 class="card-title">€ {{$sponsorships[1]['price']}}{{-- {{$sponsorship->price}} --}}</h2>
                            <hr class="border_color_s">
                            <p class="card-title">Sponsorizza il tuo appartamento per {{$sponsorships[1]['duration']}}{{-- {{$sponsorship->duration}} --}} ore!</p>
                            <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                            <input type="hidden" name="price" value="{{$sponsorships[1]['price']}}{{-- {{$sponsorship->price}} --}}">
                            <input type="hidden" name="sponsorship_id" value="{{$sponsorships[1]['id']}}{{-- {{$sponsorship->id}} --}}">
                            <button type="button" class="btn pink_s" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}" data-sponsorship-id="{{$sponsorships[1]['id']}}{{-- {{ $sponsorship->id }} --}}">
                                Go to Checkout
                            </button>
                        </div>

                        {{-- Gold sponsorship --}}
                        <div class="card col-lg-4 mt-4 mb-5 border_color_g pt-3 pb-3">
                            @csrf
                            <h2 class="card-title gold">{{$sponsorships[2]['name']}}</h2>
                            <h2 class="card-title">€ {{$sponsorships[2]['price']}}{{-- {{$sponsorship->price}} --}}</h2>
                            <hr class="border_color_g">
                            <p class="card-title">Sponsorizza il tuo appartamento per {{$sponsorships[2]['duration']}}{{-- {{$sponsorship->duration}} --}} ore!</p>
                            <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                            <input type="hidden" name="price" value="{{$sponsorships[2]['price']}}{{-- {{$sponsorship->price}} --}}">
                            <input type="hidden" name="sponsorship_id" value="{{$sponsorships[2]['id']}}{{-- {{$sponsorship->id}} --}}">
                            <button type="button" class="btn pink_g" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}" data-sponsorship-id="{{$sponsorships[2]['id']}}{{-- {{ $sponsorship->id }} --}}">
                                Go to Checkout
                            </button>
                        </div>
                 {{--    @endforeach --}}
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

    /* Color */

    .pink_b {
        background-color: #ff385c;
        color: white;
    }
    .pink_s {
        background-color: #ff385c;
        color: white;
    }
    .pink_g {
        background-color: #ff385c;
        color: white;
    }

    /* Btn bronze */
    .bronze{
        color: #cc8e34;
    }
    .border_color_b{
        border: 2px solid #cc8e34;
    }
    .pink_b:hover {
        color: #cc8e34;
        border: 1px solid #cc8e34;
        transform: scale(1.05);
    }


    /* Btn silver */
    .silver{
        color: #b7c1cd;
    }
    .border_color_s{
        border: 2px solid #b7c1cd;
    }
    .pink_s:hover {
        color: #b7c1cd;
        border: 1px solid #b7c1cd;
        transform: scale(1.05);
    }

    /* Btn gold */
    .gold{
        color: #dfc76c;
    }
    .border_color_g{
        border: 2px solid #dfc76c;
    }
    .pink_g:hover {
        color: #dfc76c;
        border: 1px solid #dfc76c;
        transform: scale(1.05);
    }
    
    


</style>

@endsection
