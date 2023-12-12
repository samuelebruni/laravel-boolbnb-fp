@extends('layouts.admin')

@section('content')
<h2 class="my-5 text-dark text-center">Edit Apartment 👉 <strong>{{$apartment->name}} 🏡</h2>


<div>

</div>
<div class="card">
    <div class="card-body">
        <form action="{{route('admin.apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="example" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ? old('name') : $apartment->name }}">
                @error('name')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <div id="tomtom-searchbox-container"></div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <input type="hidden" name="address" id="address">
                <input type="hidden" name="municipality" id="municipality">

            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description') ? old('description') : $apartment->description }}</textarea>
                @error('description')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3 d-flex">

                <div class="col-3 me-5">
                    <label for="" class="form-lable mb-2">Change a main photo of the apartment</label>
                    <input type="file" class="form-control" name="cover_image" id="cover_image" value="{{ old('cover_image') ? old('cover_image') : $apartment->cover_image }}" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
                <div class="col-3 me-5">
                    <label for="" class="form-lable mb-2">Upload images for the apartments:</label>
                    <input type="file" id="images" class="form-control" name="images[]" multiple>
                </div>

            </div>

            <div class="col-3 mb-5 me-5">
                <div>
                    @if (str_contains($apartment->cover_image, 'http'))
                    <img width="250" class=" img-fluid" src="{{ $apartment->cover_image }}">
                    @else
                    <img width="250" class=" img-fluid" src="{{asset('storage/' . $apartment->cover_image)}}" alt="">
                    @endif
                </div>
            </div>

            <div class="mb-3">

                <label for="services" class="form-label">Services</label>
                <select class="form-select" multiple name="services[]" id="services">

                    <option disabled>Select Services</option>

                    @foreach ($services as $service )

                    @if ($errors->any())
                    <option value="{{$service->id}}" {{in_array($service->id, old('services', []) )  ? 'selected' : ''}}>{{$service->name}}</option>

                    @else
                    <option value="{{$service->id}}">
                        {{$service->name}}
                    </option>
                    @endif
                    @endforeach

                </select>
                @error('services')
                <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3 d-flex">
                <div class="col-3 me-5">
                    <label for="" class="form-lable mb-2">Number of rooms</label>
                    <input type="number" name="rooms" id="rooms" class="form-control" value="{{ old('rooms') ? old('rooms') : $apartment->rooms }}">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="form-lable mb-2">Number of bedrooms</label>
                    <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms') ? old('bedrooms') : $apartment->bedrooms }}">
                </div>
                <div class="col-3 ms-5">
                    <label for="" class="form-lable mb-2">Number of beds</label>
                    <input type="number" name="beds" id="beds" class="form-control" value="{{ old('beds') ? old('beds') : $apartment->beds }}">
                </div>
            </div>
            <div class="mb-3 d-flex">
                <div class="col-3 me-5">
                    <label for="" class="mb-2">Indicate the mq</label>
                    <input type="number" name="mq" id="mq" class="form-control" value="{{ old('mq') ? old('mq') : $apartment->mq }}">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="mb-2">Indicate max guests</label>
                    <input type="number" name="max_guests" id="max_guests" class="form-control" value="{{ old('max_guests') ? old('max_guests') : $apartment->max_guests }}">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="mb-2">Number of bathrooms</label>
                    <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms') ? old('bathrooms') : $apartment->bathrooms }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="col-6 d-flex gap-3">
                    <label for="" class="mb-2">Does the apartment have to be visible?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="visible" value="1" {{ old('visible', $apartment->visible) == '1' ? 'checked' : '' }} />
                        <label class="form-check-label text-capitalize" for="">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="visible" value="0" {{ old('visible', $apartment->visible) == '0' ? 'checked' : '' }} />
                        <label class="form-check-label text-capitalize" for="">No</label>
                    </div>
                </div>
            </div>
            <button class="btn mt-3 btn_hover text-white" type="submit" style="background-color: #FF385C;"><strong>Save your apartament</strong>
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
            language: "en-US",
            limit: 5,
        },
        autocompleteOptions: {
            key: "C1hD0sgXZDUkeMEZv5sG1rcdkSZbr1dX",
            language: "en-US",
        },
    };

    var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);

    ttSearchBox.on("tomtom.searchbox.resultselected", function(event) {
        if (event.data && event.data.result && event.data.result.address) {
            var address = event.data.result.address;

            // Log the selected result data to the console

            // Update the hidden latitude and longitude input fields in the form
            document.getElementById("latitude").value = event.data.result.position.lat;
            document.getElementById("longitude").value = event.data.result.position.lng;

            // Extract the municipality from the address and update the input field
            document.getElementById("municipality").value = address.municipality;

            document.getElementById("address").value = address.freeformAddress;

        }
    });

    // Append the SearchBox to the designated container
    var searchBoxContainer = document.getElementById("tomtom-searchbox-container");
    searchBoxContainer.appendChild(ttSearchBox.getSearchBoxHTML());
</script>
</script>
@endsection