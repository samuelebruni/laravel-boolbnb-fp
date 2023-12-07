@extends('layouts.admin')

@section('content')
<h2 class="my-5 text-dark text-center">Create your profile Apartment</h2>

<div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <div id="tomtom-searchbox-container"></div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-lable mb-2">Select a photo of the apartment</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>

            <div class="mb-3">
                <label for="services" class="form-label">Services</label>
                <select class="form-select" multiple name="services[]" id="services">
                    <option disabled>Select Services</option>
                    @foreach ($services as $service )
                    @if ($errors->any())
                    <option value="{{ $service->id }}" {{ in_array($service->id, old('services', []) )  ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                    @else
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endif
                    @endforeach
                </select>
                @error('services')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 d-flex">
                <div class="col-3 me-5">
                    <label for="rooms" class="form-lable mb-2">Number of rooms</label>
                    <input type="number" name="rooms" id="rooms" class="form-control">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="bedrooms" class="form-lable mb-2">Number of bedrooms</label>
                    <input type="number" name="bedrooms" id="bedrooms" class="form-control">
                </div>
                <div class="col-3 ms-5">
                    <label for="beds" class="form-lable mb-2">Number of beds</label>
                    <input type="number" name="beds" id="beds" class="form-control">
                </div>
            </div>

            <div class="mb-3 d-flex">
                <div class="col-3 me-5">
                    <label for="mq" class="mb-2">Indicate the mq</label>
                    <input type="number" name="mq" id="mq" class="form-control">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="max_guests" class="mb-2">Indicate max guests</label>
                    <input type="number" name="max_guests" id="max_guests" class="form-control">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="bathrooms" class="mb-2">Number of bathrooms</label>
                    <input type="number" name="bathrooms" id="bathrooms" class="form-control">
                </div>
            </div>

            <button class="btn mt-3 btn_hover text-white" type="submit" style="background-color: #FF385C;">
                <strong>Save your apartment</strong>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save ms-2" viewBox="0 0 16 16">
                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    var options = {
        searchOptions: {
            key: "C1hD0sgXZDUkeMEZv5sG1rcdkSZbr1dX",
            language: "it-IT",
            limit: 5,
        },
        autocompleteOptions: {
            key: "C1hD0sgXZDUkeMEZv5sG1rcdkSZbr1dX",
            language: "it-IT",
        },
    };

    var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);

    ttSearchBox.on("tomtom.searchbox.resultselected", function(event) {
        if (event.data && event.data.result && event.data.result.position) {
            var position = event.data.result.position;

            // Update the hidden latitude and longitude input fields in the form
            document.getElementById("latitude").value = position.lat;
            document.getElementById("longitude").value = position.lng;
        }
    });

    // Append the SearchBox to the designated container
    var searchBoxContainer = document.getElementById("tomtom-searchbox-container");
    searchBoxContainer.appendChild(ttSearchBox.getSearchBoxHTML());
</script>
@endsection