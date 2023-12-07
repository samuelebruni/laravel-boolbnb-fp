@extends('layouts.admin')

@section('content')



<h2 class="my-5 text-dark text-center">Create your profile Apartament 🏡</h2>
<div class="card">
    <div class="card-body">
        <form action="{{route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="example" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name')}}">
                @error('name')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="example" class="form-label">Where the apartment is longitude?</label>
                <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" value="{{ old('longitude') }}">
                @error('longitude')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="example" class="form-label">Where the apartment is latitude?</label>
                <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" value="{{ old('latitude')  }}">
                @error('latitude')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3 d-flex">
                
                <div class="col-3 me-5">
                    <label for="" class="form-lable mb-2">Select a photo of the apartment</label>
                    <input type="file" class="form-control" name="cover_image" id="cover_image" value="{{ old('cover_image') }}" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
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
                    <input type="number" name="rooms" id="rooms" class="form-control" value="{{ old('rooms')}}">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="form-lable mb-2">Number of bedrooms</label>
                    <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms') }}">
                </div>
                <div class="col-3 ms-5">
                    <label for="" class="form-lable mb-2">Number of beds</label>
                    <input type="number" name="beds" id="beds" class="form-control" value="{{ old('beds')}}">
                </div>
            </div>
            <div class="mb-3 d-flex">
                <div class="col-3 me-5">
                    <label for="" class="mb-2">Indicate the mq</label>
                    <input type="number" name="mq" id="mq" class="form-control" value="{{ old('mq') }}">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="mb-2">Indicate max guests</label>
                    <input type="number" name="max_guests" id="max_guests" class="form-control" value="{{ old('max_guests')}}">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="mb-2">Number of bathrooms</label>
                    <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms')}}">
                </div>
            </div>
            <div class="mb-3">
                <div class="col-6 d-flex gap-3">
                    <label for="" class="mb-2">Does the apartment have to be visible?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="visible" value="1" {{ old('visible') == '1' ? 'checked' : '' }} />
                        <label class="form-check-label" for="">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="is_not_visible" value="0" {{ old('visible', 0) == '0' ? 'checked' : '' }} />
                        <label class="form-check-label" for="">No</label>
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



@endsection