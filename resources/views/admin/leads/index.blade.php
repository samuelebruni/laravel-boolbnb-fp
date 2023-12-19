@extends('layouts.admin')

@section('content')
    
<style>
    .pink, thead>tr>th, table{
        color: #ffffff !important;
        background: #ff385c !important;
        border: 1px solid #ff385c !important;
    }
</style>

<div class="container">
    <h2 class="fs-4 text-secondary pt-4 my-4">My Messages</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Apartment</th>
                <th scope="col">Phone</th>
                <th scope="col">Message</th>
                <th scope="col">From</th>
                <th scope="col">Received</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $message)
                @foreach($apartments as $apartment)
                    @if($message->apartment_id == $apartment->id && $apartment->user_id == $user->id)
                        <tr>
                            <td>{{$apartment->name}}</td>
                            <td>{{$message->phone}}</td>
                            <td class="w_100">{{$message->message}}</td>
                            <td>{{$message->email}}</td>
                            <td>{{$message->created_at}}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$message->id}}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="modalId-{{$message->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{$message->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        Attenzione! Se procedi eliminando questo messaggio non potrai più visualizzarlo, confermi? 📛
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <!-- Delete form -->
                                        <form action="{{route('admin.leads.destroy', $message->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@endsection
