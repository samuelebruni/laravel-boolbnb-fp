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

                    <h1>
                        N/A
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
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