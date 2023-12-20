@extends('layouts.admin')

@section('content')

@if($apartments->isEmpty())
    <h4 class="my-5">No payments have been made.. 💔</h4>
@else
    <h4 class="my-5">Payment History 💸</h4>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Apartment Name</th>
                <th scope="col">Sponsorship Name</th>
                <th scope="col">Mount</th>
                <th scope="col">Start Sponsorship</th>
                <th scope="col">Expired Sponsorship</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apartments as $apartment)
                @if($apartment->sponsorships->isNotEmpty())
                    <tr>
                        <td>{{ $apartment->name }}</td>
                        @foreach($apartment->sponsorships as $sponsorship)
                            <td>{{ $sponsorship->name }}</td>
                            <td>{{ $sponsorship->price }}€</td>
                            <td>{{ $sponsorship->pivot->start_sponsorship }}</td>
                            <td>{{ $sponsorship->pivot->expired_sponsorship }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endif

@endsection
