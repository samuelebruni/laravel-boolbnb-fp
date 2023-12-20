@extends('layouts.admin')

@section('content')
    <style>
        .pink,
        
        table {
            color: #ffffff !important;
            background: #ff385c !important;
            border: 1px solid #ff385c !important;
        }
        th, td{
            height: 50px;
            display: flex;
            align-items: center;
        }
        th{
            background: #ff385c !important;
            color: #ffffff !important;
            border: 1px solid #ff385c !important;
        }

    </style>

    <div class="container-fl">
        <h2 class="fs-4 text-secondary pt-4 my-4">My Messages</h2>

        @foreach ($leads as $message)
            @foreach ($apartments as $apartment)
                @if ($message->apartment_id == $apartment->id && $apartment->user_id == $user->id)
                    <table class="table table-responsive rounded-3 table-striped d-flex ">
                        <div class="container">
                            <thead class="h-100">
                                <tr class="table-active d-flex flex-column">
                                    <th scope="col">Apartment</th>
                                    <th scope="col">Phone</th>
                                    {{--  <th scope="col">Message</th> --}}
                                    <th scope="col">Received</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="w-100">
                                <tr class="d-flex flex-column">
                                    <td>{{ $apartment->name }}</td>
                                    <td>{{ $message->phone }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>{{ $message->email }}</td>

                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $message->id }}">
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                                <div class="modal fade" id="modalId-{{ $message->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Attenzione! Se procedi eliminando questo messaggio non potrai più
                                                visualizzarlo,
                                                confermi? 📛
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>

                                                <!-- Delete form -->
                                                <form action="{{ route('admin.leads.destroy', $message->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </div>



                        <script>
                            var modalId = document.getElementById('modalId');

                            modalId.addEventListener('show.bs.modal', function(event) {
                                // Button that triggered the modal
                                let button = event.relatedTarget;
                                // Extract info from data-bs-* attributes
                                let recipient = button.getAttribute('data-bs-whatever');

                                // Use above variables to manipulate the DOM
                            });
                        </script>


                    </table>
                @endif
            @endforeach
        @endforeach

    </div>
@endsection
