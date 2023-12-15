@extends('layouts.admin')

@section('content')
    
<div class="container">
    <h2 class="mt-3 mb-5">My Messages</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Apartment</th>
                <th scope="col">Phone</th>
                <th scope="col">Message</th>
                <th scope="col">From</th>
                <th scope="col">Received</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $message)
            @foreach($apartments as $apartment)
            @if($message->apartment_id == $apartment->id && $apartment->user_id == $user->id)
            <tr>
                <td>{{$apartment->name}}</td>
                <td>{{$message->phone}}</td>
                <td>{{$message->message}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->created_at}}</td>
            </tr>
            @endif
            @endforeach
            @endforeach
        </tbody>
  </table>
</div>

@endsection