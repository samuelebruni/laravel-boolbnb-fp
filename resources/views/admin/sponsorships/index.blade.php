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
                        @foreach ($sponsorships as $sponsorship)
                            <div class="card col-lg-4 mt-4 mb-5 border_color_{{ strtolower($sponsorship['name'][0]) }} pt-3 pb-3">
                                @csrf
                                <h2 class="card-title {{ strtolower($sponsorship['name'][0]) }}">{{$sponsorship['name']}}</h2>
                                <h2 class="card-title">€ {{$sponsorship['price']}}</h2>
                                <hr class="border_color_{{ strtolower($sponsorship['name'][0]) }}">
                                <p class="card-title">Sponsorizza il tuo appartamento per {{$sponsorship['duration']}} ore!</p>
                                <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                                <input type="hidden" name="price" value="{{$sponsorship['price']}}">
                                <input type="hidden" name="sponsorship_id" value="{{$sponsorship['id']}}">
                                <a class="btn pink_{{ strtolower($sponsorship['name'][0]) }}" href="{{ route('admin.sponsorships.payment.index', ['sponsorship' => $sponsorship['id'], 'apartment' => $apartment->id]) }}">
                                    Go to Checkout
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

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