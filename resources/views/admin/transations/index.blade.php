@extends('layouts.admin')

@section('content')
    <style>
        .pink,

        table {
            color: #ffffff !important;
            background: #ff385c !important;
            border: 1px solid #ff385c !important;
        }

        th,
        td {
            height: 50px;
            display: flex;
            align-items: center;
        }

        th {
            background: #ff385c !important;
            color: #ffffff !important;
            border: 1px solid #ff385c !important;
        }
    </style>

    @if ($apartments->isEmpty())
        <h2 class="fs-4 text-secondary pb-3 mt-3 mb-4">No payments have been made.. 💔</h2>
    @else
        <h2 class="fs-4 text-secondary pb-3 mt-3 mb-4">Payment History 💸</h4>

        <div class="container-fl">


            @foreach ($apartments as $apartment)
                @if ($apartment->sponsorships->isNotEmpty())
                    <table class="table table-responsive rounded-3 table-striped d-flex ">
                        <div class="container">
                            <thead class="h-100">
                                <tr class="table-active d-flex flex-column">
                                    <th scope="col">Apartment Name</th>
                                    <th scope="col">Sponsorship Name</th>
                                    <th scope="col">Mount</th>
                                    <th scope="col">Start Sponsorship</th>
                                    <th scope="col">Expired Sponsorship</th>
                                </tr>
                            </thead>
                            <tbody class="w-100">
                                <tr class="d-flex flex-column">
                                    <td>{{ $apartment->name }}</td>
                                    @foreach ($apartment->sponsorships as $sponsorship)
                                        <td>{{ $sponsorship->name }}</td>
                                        <td>{{ $sponsorship->price }}€</td>
                                        <td>{{ $sponsorship->pivot->start_sponsorship }}</td>
                                        <td>{{ $sponsorship->pivot->expired_sponsorship }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </div>

                    </table>
                @endif
            @endforeach


        </div>
    @endsection

@endif
