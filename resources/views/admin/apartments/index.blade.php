@extends('layouts.admin')

@section('content')


    <section class="container my-5">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="text-muted text-uppercase">All Apartments</h4>
            <a href="{{route('admin.apartments.create')}}" class="btn btn-primary">Add Apartment 🏡</a>
        </div>

        <div class="my-1">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{session('message')}}</strong> 
            </div>
            @endif
        </div>

        <div class="card">

            <div class="table-responsive-sm">
                <table class="table table-light mb-0">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">N. Stanze</th>
                            <th scope="col">N. Bagni</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">


                        @forelse ($apartments as $apartment)
                        <tr class="">
                            <td scope="row">{{$apartment->id}}</td>
                            <td>
                                
                                @if (str_contains($apartment->cover_image, 'http'))
                                    <img width="100" class=" img-fluid" src="{{ $apartment->cover_image }}">
                                @else
                                    <img width="100" class=" img-fluid" src="{{asset('storage/' . $apartment->cover_image)}}" alt="">
                                @endif

                            </td>
                            <td class="w-25">{{$apartment->name}}</td>
                            <td>{{$apartment->rooms}}</td>
                            <td>{{$apartment->bathrooms}}</td>
                            <td>

                                <a href="{{route('admin.apartments.show', $apartment->id)}}" class="btn btn-primary">View</a>
                                <a href="{{route('admin.apartments.edit', $apartment->id)}}" class="btn btn-secondary">Edit</a>
                                
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                                    Delete
                                </button>

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

                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    

    </section>


@endsection