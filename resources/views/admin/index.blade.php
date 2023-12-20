@extends('layouts.admin')

@section('content')

<div class="container">
    <h2 class="fs-4 text-secondary pt-4 my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Apartments</div>

                <div class="card-body">
                    <h1>

                        {{$allApartments}}


                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Messages</div>

                <div class="card-body ">



                    <h1>

                        {{$allLeads}}
                    </h1>



                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Transations</div>

                <div class="card-body">


                    <h1>
                        {{$allTransations}}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/*     .card-body {
        color: #ff385c;
    } */
    .card-header{
        color: #ffffff !important;
        background: #ff385c !important;
        border: 1px solid #ff385c !important;
    }
    .card{
        border: 1px solid #ff385c !important;
    }
</style>
@endsection