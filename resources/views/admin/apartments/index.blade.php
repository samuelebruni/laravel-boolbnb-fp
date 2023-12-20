@extends('layouts.admin')

@section('content')


<style>
    .pink {
        background-color: #ff385c;
        color: white;
    }

    .pink:hover {
        color: #ff385c;
        border: 1px solid #ff385c;
        transform: scale(1.05);
    }

    .money {
        background-color: gold;
        color: #ff385c;
    }

    .money:hover {
        color: #ff385c;
        border: 1px solid #ff385c;
        transform: scale(1.05);
    }
    .coverimage{
        width: 100%;
        height: 200px;
    }
</style>


<section class="container my-5">
    <div class="d-flex flex-sm-wrap justify-content-between mb-3">
        <h4 class="text-muted text-uppercase">All Apartments</h4>

        <div>
            <a href="{{route('admin.apartments.create')}}" class="btn pink">Add Apartment <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg></a>
        </div>


    </div>

    <div class="my-1">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{session('message')}}</strong>
        </div>
        @endif
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse ($apartments as $apartment)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 d-flex">
            <div class="card w-100">
                <a href="{{route('admin.apartments.show', $apartment->slug)}}">
                    <img class="coverimage" src="{{ str_contains($apartment->cover_image, 'http') ? $apartment->cover_image : asset('storage/' . $apartment->cover_image) }}" class="card-img-top" alt="Apartment Image">
                </a>

                <div class="card-body">
                    <h5 class="card-title">{{$apartment->name}}</h5>
                    @if($apartment->visible)
                    <p class="text-success mt-3">Apartment is active</p>
                    @else
                    <p class="text-danger mt-3">Apartment is not active</p>
                    @endif
                    <hr>
                    <div class="d-flex justify-content-around">
                        <a href="{{route('admin.apartments.show', $apartment->slug)}}" class="btn pink">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                            </svg>
                        </a>
                        <a href="{{route('admin.apartments.edit', $apartment->slug)}}" class="btn pink">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                            </svg>
                        </a>
                        <button type="button" class="btn pink" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{$apartment->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle-{{$apartment->id}}">Identificativo appartamento 🏡: {{$apartment->id}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Attenzione! Se procedi eliminando questo appartamento non potrai più tornare indietro, confermi? 📛
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <!-- Delete form -->
                        <form action="{{route('admin.apartments.destroy', $apartment->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>No apartments found.</p>
        @endforelse
    </div>
</section>

<style>
    .pink {
        background-color: #ff385c;
        color: white;
    }

    .pink:hover {
        color: #ff385c;
        border: 1px solid #ff385c;
        transform: scale(1.05);
    }

    .money {
        background-color: gold;
        color: #ff385c;
    }

    .money:hover {
        color: #ff385c;
        border: 1px solid #ff385c;
        transform: scale(1.05);
    }

    .coverimage {
        width: 100%;
        height: 200px;
    }

    .h_80 {
        height: 80px;
    }
</style>

@endsection
