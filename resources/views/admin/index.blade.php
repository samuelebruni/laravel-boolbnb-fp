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
                    <a href="{{route('admin.apartments.index')}}">
                        <h1>

                            {{$allApartments}}


                        </h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Messages</div>

                <div class="card-body ">

                    <a href="{{route('admin.leads.index')}}">

                        <h1>

                            {{$allLeads}}
                        </h1>
                    </a>


                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Transations</div>

                <div class="card-body">

                    <a href="{{route('admin.transations.index')}}">
                        <h1>
                            {{$allTransations}}
                        </h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm mt-3 col-lg-4">
            <div class="card text-center">
                <div class="card-header bg-white">Go to</div>

                <div class="card-body">

                    <a href="http://localhost:5174/#/">
                        <h1>
                            Homepage
                        </h1>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /*     .card-body {
        color: #ff385c;
    } */
    .card-header {
        color: #ffffff !important;
        background: #ff385c !important;
        border: 1px solid #ff385c !important;
    }

    .card {
        border: 1px solid #ff385c !important;
    }

    a {
        text-decoration: none;
        color: black;
    }
</style>
@endsection