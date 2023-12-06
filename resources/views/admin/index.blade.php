@extends('layouts.admin')

@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Numero Appartamenti</div>

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

                        AAAAAA
                    </h1>



                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Pagamenti</div>

                <div class="card-body">

                    <h1>

                        AAAAAA
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div id="map">a</div>

<script>
    // Initialize the map
    var map = tt.map({
        key: 'WPApwm8lHb7DnfQ5RbyxS9nOlbdisKzH',
        container: 'map',
        style: 'tomtom://vector/1/basic-main',
        center: [0, 0], // Initial center coordinates (longitude, latitude)
        zoom: 10 // Initial zoom level
    });
</script> -->

<style>
    .card-body {
        color: #ff385c;

    }

    #map {
        height: 400px;
        width: 100%;
    }
</style>
@endsection