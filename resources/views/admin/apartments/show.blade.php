@extends('layouts.admin')

@section('content')
    <style>
        .pink {
            background-color: #ff385c;
            color: white;
        }

        .pink:hover {
            color: #ff385c;
            border: 1px solid #ff385c;
            transform: scale(1.05);
        }

        .money {
            background-color: gold;
            color: #ff385c;
        }

        .money:hover {
            color: #ff385c;
            border: 1px solid #ff385c;
            transform: scale(1.05);
        }

        .details_info {
            width: 80%;
        }

        .cover_image {
            width: 550px;
            height: 350px;
        }

        .description {
            margin: 0rem 1rem 0;
        }

        .show_images {
            text-decoration-line: underline;
            color: #ff385c;
            cursor: pointer;
        }

        .modal-dialog {
            max-width: 800px;
        }
        .maps_box{
            width: 700px;
        }
        .maps_width{
            width: 700px;
            height: 350px;
            margin: -3rem 0 0;
        }

        /* spacing */

        .mx_auto {
            margin: 0 auto;
        }

        .ms_5 {
            margin: 0 0 0 5rem;
        }
    </style>
    <div class="my-1">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{session('message')}}</strong>
        </div>
        @endif
    </div>

    <div class="mt-3">Show Apartment NAME 👉 <strong>{{ $apartment->name }} 🏡</strong></div>
    <div>
        <a href="{{ route('admin.sponsorships.index', $apartment) }}" class="btn btn-dark">Sponsorizza il tuo
            appartamento</a>
    </div>

    <div class="container details_info mt-3">
        <div class="row mx_auto g-4">
            <div class="col-sm-12 col-md-8 col-lg-12 d-flex">

                <div class="title_image">

                    <img class="cover_image"
                        src="{{ str_contains($apartment->cover_image, 'http') ? $apartment->cover_image : asset('storage/' . $apartment->cover_image) }}"
                        class="card-img-top" alt="Apartment Image">
                    <p class="show_images" data-bs-toggle="modal" data-bs-target="#exampleModal">Show others images</p>

                    <h2 class="card-title text-center my-5">{{ $apartment->name }}</h2>

                    <div class="d-flex justify-content-around my-5">
                        <a href="{{ route('admin.apartments.edit', $apartment->slug) }}" class="btn pink">Edit</a>
                        <button type="button" class="btn pink" data-bs-toggle="modal"
                            data-bs-target="#modalId-{{ $apartment->id }}">
                            Delete
                        </button>

                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalId-{{ $apartment->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $apartment->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitle-{{ $apartment->id }}">Identificativo
                                            appartamento 🏡: {{ $apartment->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Attenzione! Se procedi eliminando questo appartmaneto non potrai più tornare
                                        indietro, confermi? 📛
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>

                                        <!-- Delete form -->
                                        <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="description">

                    <!-- map -->
                    <div class="maps_box mx_auto my-5 text-center">

                        <div id="map-{{ $apartment->id }}" class="maps_width"></div>

                        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>

                        <script>
                            // Access the dynamic data from the server-side
                            let apartment = @json($apartment);

                            // Set product information
                            tt.setProductInfo("map", "1.0.0");

                            // Create a map instance
                            const map = tt.map({
                                key: "C1hD0sgXZDUkeMEZv5sG1rcdkSZbr1dX",
                                container: "map-" + apartment.id,
                                center: [apartment.longitude, apartment.latitude], // Use the dynamic latitude and longitude
                                zoom: 16,
                            });


                            // Add a marker at the specified center coordinates
                            const marker = new tt.Marker({
                                color: '#ff385c',
                            }).setLngLat([apartment.longitude, apartment.latitude]).addTo(map);
                        </script>

                        <!-- map -->
                    </div>

                    <h6 style="margin: -2rem 0 0">Description: </h6>
                    <p class="mb-2">{{ $apartment->description }}</p>

                    <div class="card-body details_info mx_auto my-3">
                        <div class="d-flex justify-content-between">

                            <div class="card-body d-flex flex-column justify-content-between align-items-start pb-0 ">

                                <h6 class="d-flex align-items-center ">
                                    <img class="me-3"
                                        src="data:image/png;base64,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">
                                    Rooms: {{ $apartment->rooms }}
                                </h6>

                                <h6 class="d-flex align-items-center ">
                                    <img class="me-3"
                                        src="data:image/png;base64,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">
                                    Bedrooms: {{ $apartment->bedrooms }}
                                </h6>

                                <h6 class="d-flex align-items-center me-1">
                                    <img class="me-3"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFw0lEQVR4nO2Ze0xTVxjAz8im3MoimYkmzpnpom7qjNmWuWVuziWbJj5aZE4nPnBuouLUsSk+cIgPBlgdPsMo2lsebiIuaDsHVCyo9N4WmCDUFwiF8ihKaTXLMqrbt9wjXGl7b6lS5Lr0S35/nO/0tOeXe8757r1FyBe+8IUv/n+RWjQYkVQqktPqXoOkVEihndK7IiQtRSQNnBylwC8xF/wSczzimeQL3N/DIKereltEzvfjAzfJQSTZ6DGBobH8IiRl7TORSVGyRxIZGhIjHJGAdD0EZhRj3tsqgwGSjZAwYhFMmfw15+SHzNgAh4eFwJhPIuDFkBh2LIOfoo9EPs+/AlabDWwdfClNg8BZkUCLJLB23BecIm99uA73z5wUDi8v3s6OZUgz1PeNyMZCg8NECovLYfXuVKACgkA+NQLC9qS6ELNKikVil8WBLFvtMP7CzYY+EimodJiI1WoFs9kMxZO/AXpgMJRN3QDlH29yQP/SIqAHfQbG0kpobW0VpoitgxvUH1AyJxp0ry4D3ailDug/iIDLaSos7TxOcCJWqxVMJhPU1NS4UFdXBxaLhXOc4ERsj4kgRIqvVMOU9QfhnXWJID1xFueSlOdxm4tZ0TK41WoRnkjZjVqYHZ0C07YkYQEml5pH4TYXC+PToNXSJjwRm9CXlv00WtGuREu6EzHcrIdFCekwbxeJrwSTO1FQgttchB84AW1OJ9ejiOhEkiU6QrLCcxElymhXon/tKrTcnQhVUQUTw6Xw2ldxsCP9d5zbm5WP21ww+6nltmMd0VYb4TkF1a0ITYjDmKJKE+J0j0UgExF2Jcq2K5HMnUiPYK7MFTXYaBIatKkQ/GteNyISGSUSZ2vRXAI9dvCI1JiaYItcCetl2XCGuoxzZ0sMuM1F/C957Ng2YzmW6KSpSAH+Cq2X9gjzhEZSkYikw5BG82x3IvmlBnhhbhS+MVx7OAvntpIq3lv4EaE7wdyxtG4ZChxEGEZnaO66n59u0IOnSboEkVQM/wfl1LmOJ7V76Ih+ZHciPcFccc5VRJH/p3dEMiv7YQFmQNfgEWlsuQ0/nsyHXRk5oDNU41zptRqIPZaLc87Ic7Ts2OZrOqelRYJ/SuEd5O0o8Z85XN9/zkh3Isy+6Fw2odIMnFtzKIt3aTHLsHNpNTc1QWPxKSxhukhCkOy4281uV6IU5gBiDiKPJbSioDdoQmyhCLHKnQjDdWMDlFcZ2YrN1InLVXU450x9Uwv+zA8/58LrKxJgzLJYGLV0J4jmbwNiwXbwD427LxJvnsgpokLLO0qC58cvTUg0NCFu0Q2YNc6dyG2LBU4WlkKamsZCTK66vhHS1Tqc6+RqrYk9cs3G6/B22DbOKzZo7iaYFxlbYNMfebg/uwRTpJli7bGIrp9k9EVi9lA2wSNyuugSO4mQ+DScW3Ug02WCn+44CjZrG9jKleye2H840fFEWxgFFTnJuM9Ky+/bKHIl8nrwiDDLiKkbyqIyqGs041xD8y1QactxrpPahmZoq6t0OaXGhn7PimyTJjj2U/I7ANF+T0TkUWi5pnUR+WjlQ5GkQ7td+q2X5IECFKFcJvr+8gfFlOHg/niX/hZNZoDgRJprrzpM0lSQAoODvmNFFn8b5bS0yDLvSnhJhHl7YixVgbkoGbQn42BaaDiIxJGsCDF9LezcHAUVWQf/ac1JOm8+ljhBcCJ3GzTQnv8K2FWIpV2JoDBlGIxcsBqmvxsOuQOD8buvLtyjReLjZ9D0/oIR+Vsz3kGiK2TseNA8P8dZAjqhiKA1vSIyX1Xq8MrUE+y/+fGK6HcM55WgsYj4SK+IoJ8KIEB6CgL3nPYYPgmGkj1j3YrQhETuRREqhf+vgO5xJ1K8b8ITFFHoZiKSsj/9IkzIqCGIpN98HNyJNO8dYnyyIj2IdiXa165Cai7+yugXQYnEmTQhUbsizqNFQTN68tu+8IUvfIEEGf8BxUs0j8M41ZUAAAAASUVORK5CYII=">
                                    Max Guests: {{ $apartment->max_guests }}
                                </h6>

                            </div>

                            <div class="card-body d-flex flex-column justify-content-between align-items-start pb-0 ms_5">

                                <h6 class="d-flex align-items-center me-4">
                                    <img class="me-3"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFeUlEQVR4nO2Z708TdxzHOxP3ZM5H2zKXuGR/wNzikz3Yg+3BnuzZWGlYhiZzrQaJ1EWM9Fo2t0FvoD6gmyZI3LIZFxxzw2hbpK0i8kvvKFXpaAu9oxAQLCACvZbetfdZvkdbIPTn9SZ14Z28A7Tfe3+/Lz6f+36vqUy2pS39v4Tp7Xs0OPGjBifuYXqSymQNTtxD46vq+t+WFYJOnoRtGpz4QYMTUQwnIVdrcCKqwUk9ytlUEA1O1KMFaXESmq9S8I9nHiYeBWBiilnnsUkGLINL8Ld9EVrtC9D9YA6aWynhOgFKT+KbBqGt7d+L6QkeLcYxOAuptBwB6JuIgJXm4NYoBzMMn3hv4OGsAIMqo6299+6mgGhwsgn9N1uu0SkhGJaH7vEYhI+DueAqBNLo0ygYfqfibda4KSCYnnSiBXiop0khFsM8dI5xAsRtHwcLy+shhueiwnuXe+Zi7UU83BQQDU5OowVM+YMbIJ6EeOjwrUDcGeNgKbwKgX4bmlmBQG51LMUqQk5vEgjhRwuYnlkP4md4uDm6ssju8QgEuTUQPMDDxyutlgC5Hwch/AUD8miJB1sMom8iItzocUV5gPvT6yEKEmR8YbVdiMkIsNFViEgUwD61ESInkA43vGKlIqU2mj1hodmqFD5uoSOKDifsEAMSv3GR0YLRwuNCQAgsGUTWIO1UZJ+FZpdShWw0+9hKcR/lAtIzHEhcj1oHtVBc4TVniGiQdi/7vpViI9lDxEyxgXZf6K1sQdBC0HVOf0S4mZF8k1PQZXeCedCfcb6MIFaa/StniAQMdzoXEM/sSi/xPA+Gi39AsVorWPFVNdQ12/IDsdCcRzwI254tCOENJFrJ1ksKACXHvoEjdY2gOKoTfKmHzqMiFDsqFsRCsR1itt9Tv1wWQM603BZydI1/Cn/Xp6lKwYGg56jvf70GZbVn4YLNKeTUXDQJIOjncwGy9jRf65rnCWRwjEmc5s81SGts+zV7GDANLQpu9y4nBUGvx8eg8QUJcrqlI7HtnrtOJgVBr8fHxDeEggNp8zCwX6PPCmTfidrCqIjD7e11uL0gtQdcI93PFMTuHtn/X4A4XFRpYhKlkflNaQo+OdwWnD98IyTKZebgvMoUnFWamJpkIACwzeH29khcjS6Um5hEZWQCKlMQpLDSGHSmrIrL9caAe2RUGggv3T/k27VugmcFgoQmd7i8nfm1k7dzA0QMZEQqEJWRsaQDibXZC3aP97MB18gdh9vLZQnAofH33SMl6PqkwQfMi69e9bC268OcPR9fGWJbSs2wU5aDXC7XyzpDU0N1w3l7taFpoxvO29H7aFxWgVaKuyt2x1qzczXLREhegZ2LH3rFyX026zArzZ3JF8RKseWiQNRYbToQuVqbdCdMKpsvvNdCsXwe1Qh2jMLrYkCK1VhlOhBFhe5YToEWmr0kvhrcdzKRkldov0zfWpoDOQWah2GnheYeiDnVW5zwolgQhVpblA7k06PYJzmHtvlgl5XmurKGoNkr3S7IbkdJIflR3YfpWwv7QFRwfz9st1DskWuecDQVQKubDVmpyOcp9/QcVHSk6p30Nzu2R3T4oX7YrjQz0apbITjVtww/kWEwkGGo712G4zdD6OAbl0kkhbrqzXQgJcd0u0WHf3EjuDv9owjDSvU9nqL85I50IPsqK18SHX7IyLyX6XGkrH3pNZlEkqu1bIozhM0rWHWdKcr8XBWQ7Ds8uVrrT14R7HFewQeNTHkmkIOmwMcSgniSVqQCc+cVjD4gZa5ISCkVSHGF9m6KivTlFawyMj9n/OxhCn4tFYhcrW1LAWLOK1hpYi6oTAyVzkoT861UIMVqzFBcoaU2WI0ZpJpjS1uS5a5/AYkON947OwjMAAAAAElFTkSuQmCC">
                                    Bathrooms: {{ $apartment->bathrooms }}
                                </h6>

                                <h6 class="d-flex align-items-center me-4">
                                    <img class="me-3"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD4UlEQVR4nO2YX0xTVxzHb/awJ9/kZTHZHva2ZPNhL8Ys8WF/sknPpWCgVErHkv1LZnzZEnrOHbnYlhZ6L2GR/0OQKRNthWJ7TisUZAgyb9UaY9DIn8ifF4kGC0W2hclZ7rSmUyh16597s36Tz0PvuQ+/T3/nd05ahskmfWERFgEkgc2Q1xi1BCD8JQtJdSwAEgeAOMIi3M+oOSzENoDICoC+dxi1BkBcBBD5kzV5WUatyePwXhbh3wEk3zJqzX4Ov8Eico+F5DijtGg433sA4fIX4LA+9r1CfngHi/ANAMlIIe98lVFaWESMLxyriKwBSIaj7/A8/wpA5ByAeFrDe3IYNQRAUslC/Bsw4Y+fPUPEAhAOs9D3FqMWCQDJH8BENM89H2YRoZsR2znFdiIarQm/y3L4g82Q15hUR1PueX27Id5OQhHJLffujjfEcgDCZU+2CRbT/k0nef9XJnXvt5v3G844Cm72HS2c7q7WXm42f7Q71RJJT8eRTz4cbDPeX71WRR+FquiydIS6xIK7rfy+HNVIyOmuyRtYuWr5WyLK9PnvNo5bNN8w/yEA+fY83f/98YY9aXEK+VKshMziaAX92Z7XnNRhT/UPIdcWIl020MKoKa6siMLiynZEYXH9Xzoy3KrJudStOxl0Gyeuespmg27jrbHTRScCP72/U14/wAd+MDouzZWJv84km1LH2IyhevRGseWCW1sxsO9fiwx1at+UzpZMrc03U7p08hmP5puo1GOYlNd15qEWq3uRCv5wyrB7H9DDP958oLMM/ZKP/K+9lMgpO2gZdxZfX19s/4dEFPn5uFMfKramXkR4is1zn5bYL07lfR94O2GRnjrgmZO4lc0koswFuWVObPCkS0Twh2kNWaIH7SO3tabenQmJnD9WcD0yW7+lhEzkbj1tb4WhdIoI/jA1u+9RnXXIqXoRwR+mX9QFF3KRd1diWyvILccTmZXQMhIazmVCpMI5/7iQH0QJDrs+tL7YscWwd9DxM7q0DrsQg8P3kOqtFwYSP357DJPycRsrsTrXsCH1lKTt+BW24GDVyHjCF6J88Y2dKjoR7C19ciH2lk7In6MXYiZFSmwXpbgiwtFGWtN2OmJv65vfjq/F/kimRD6tCqzGFWk81kGnVmhC1PbdoZkS+cw+mBWhyupIYC3u1qptaKJ17d0biXC41rvxuThCv6obTTsGs+dxXBG14BLy459aasGVFQmprCNLlyspadQveOqLZ5QAadQvyDW9tIjS/nzosoEWuaasCKOmjnTZ2c6z4gEpFqdYcKXTmnuIUUg6rbmH5Jqer1OuPdO1JTV/AZKYyy/zk08ZAAAAAElFTkSuQmCC">
                                    Beds: {{ $apartment->beds }}
                                </h6>

                                <h6 class="d-flex align-items-center me-1">
                                    <img class="me-3"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACX0lEQVR4nO1aPWgUQRSeoIiCERHRSqLYqWCnjWVsFOyOKwN3mbdRsIgS772cOFgel513F0RiocRSq7NaRNBOLSy0UlELFW3EH1ALbVbGZCGnt7s5nN3snfPBa79vP+a+e2/erhD/B8IRiXzCBtMSTzgi8kapdHMdoF6QpO/Z4DM8QLyolFov8kJJqQ2AfAOIQ8tGQkncmZ72N4mscUpd2gzEt41oFkYiztOqvUVkharytwHyg0gwKyNLpR9NnW3uELbh1Xg3ED/vFvtt5BMQ3/nXWubp4jZ6RteeCWrvA9JvewhlX8jvvZp/0IoRQC4D6Z9rYsToIpeFLUjU4xL113xPQ3/30D8mbMOb9Q8B8Ydcwo76M9RaR0RW8P7ISyZGbOYiCZV6c0yifpZRQ3wF9fZekReqyz3FrpGMekcaKjONUUl8QViA4TF8NriGH9i4Ol/zrz1cqzL6Sc8HyOUpah1INWLIzl/uhBev38+9jK7Rj3s2j1pHAfkHkH43WZ/fk2rEkDaDL7mX0Y0zAsiHgfjbit7zskqtnQNlZPKc3g/IH3tMA08mFG8dCCMn63O7JPKbuNHG/JVPKLWx0EbgzNz2qBmnDJu3/ro2F8VIZaYxappmH4PnYtdCoyhGJDL1uJQlX/Jm9fHCGemFviZxZyRwJxK6n1YSXEYCl5HQZSQJLiOBy0joMpIEl5HAZSR0GRmEjMhhuSFW+ryzS+IrhTyRaIsCyE9XYaJT2C3Kyr0WkH4d/8qO7xZ+r5W2aZTEjwdm0xi7+yV+kbr7Leo2XqIej7bxqR8XDM37ETEE+AVmVKsknJUj1QAAAABJRU5ErkJggg==">
                                    Mq: {{ $apartment->mq }}
                                </h6>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between">

                            <div class="card-body d-flex flex-column justify-content-center align-items-start pb-0 pt-0">

                                <h6 class="d-flex align-items-center">
                                    <img class="me-3"
                                        src="data:image/png;base64,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">
                                    Visible:
                                    @if ($apartment->visible)
                                        <p class="text-success mt-3 ms-1">Apartment is active</p>
                                    @else
                                        <p class="text-danger mt-3 ms-1">Apartment is not active</p>
                                    @endif
                                </h6>

                            </div>

                        </div>

                    </div>
                </div>

            </div>



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">

                            {{-- Carousel --}}
                            <div class="container w-100 my-5">

                                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($apartment->images as $key => $image)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img class="cover_image d-block w-100"
                                                    src="{{ str_contains($image->path, 'http') ? $image->path : asset('storage/' . $image->path) }}"
                                                    alt="Immagine {{ $image->id }}">

                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExample" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
