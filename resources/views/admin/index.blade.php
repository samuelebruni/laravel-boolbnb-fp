@extends('layouts.admin')

@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Strutture Attive</div>

                <div class="card-body">
                    <h1>

                        {{$allApartments}}


                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Messaggi</div>

                <div class="card-body ">



                    <h1>

                        N/A
                    </h1>



                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Pagamenti</div>

                <div class="card-body">

                    <h1 id="map">


                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
<script>
    let center = [12.777289755797641, 43.85677975967643]
    tt.setProductInfo("map", "1.0.0")
    tt.map({
        key: "C1hD0sgXZDUkeMEZv5sG1rcdkSZbr1dX",
        container: "map",
        center: center,
        zoom: 16,
    })
    map.on('load', () => {
        new tt.Marker().setLngLat(center).addTo(map)
    })
</script>
<style>
    .card-body {
        color: #ff385c;

    }

    #map {
        width: 380px;
        height: 300px;
    }
</style>
@endsection