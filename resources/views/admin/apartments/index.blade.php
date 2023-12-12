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
</style>

<section class="container my-5">
    <div class="d-flex justify-content-between mb-3">
        <h4 class="text-muted text-uppercase">All Apartments</h4>
        <div>

            <a href="{{route('admin.apartments.create')}}" class="btn money me-3">Boost Your Apartment </a>
            <a href="{{route('admin.apartments.create')}}" class="btn pink">Add Apartment </a>
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
        <div class="col">
            <div class="card">
                <a href="{{route('admin.apartments.show', $apartment->id)}}">
                    <img src="{{ str_contains($apartment->cover_image, 'http') ? $apartment->cover_image : asset('storage/' . $apartment->cover_image) }}" class="card-img-top" alt="Apartment Image">
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
                        <a href="{{route('admin.apartments.show', $apartment->id)}}" class="btn pink">View</a>
                        <a href="{{route('admin.apartments.edit', $apartment->id)}}" class="btn pink">Edit</a>
                        <button type="button" class="btn pink" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{$apartment->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle-{{$apartment->id}}">Identificativo appartamento 🏡: {{$apartment->id}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Attenzione! Se procedi eliminando questo appartmaneto non potrai più tornare indietro, confermi? 📛
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <!-- Delete form -->
                        <form action="{{route('admin.apartments.destroy', $apartment->id)}}" method="POST">
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

@endsection