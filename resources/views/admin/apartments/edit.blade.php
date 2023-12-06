@extends('layouts.admin')

@section('content')
<h2 class="my-5 text-dark text-center">Edit apartament: </h2>

<div class="card">
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label for="example" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputText" aria-describedby="Text">
            </div>
            <div class="mb-3">
                <label for="example" class="form-label">Where the apartment is located?</label>
                <input type="text" class="form-control" id="exampleInputText" aria-describedby="Text">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-lable mb-2">Select a photo of the apartment</label>
                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>
            <div class="mb-3 d-flex">
                <div class="col-3 me-5">
                    <label for="" class="form-lable mb-2">Number of rooms</label>
                    <input type="number" class="form-control">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="form-lable mb-2">Number of bedrooms</label>
                    <input type="number" class="form-control">
                </div>
                <div class="col-3 ms-5">
                    <label for="" class="form-lable mb-2">Number of beds</label>
                    <input type="number" class="form-control">
                </div>
            </div>
            <div class="mb-3 d-flex">
                <div class="col-3 me-5">
                    <label for="" class="mb-2">Indicate the mq</label>
                    <input type="number" class="form-control">
                </div>
                <div class="col-3 me-5 ms-5">
                    <label for="" class="mb-2">Indicate max guests</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-3 ms-5">
                    <label for="" class="mb-2">Indicate if it is a smoking area</label>
                    <div class="d-flex">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                No
                            </label>
                        </div>
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