 @extends('layouts.admin')


 @section('content')


 <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>


 <div id="map" style="width: 304px; height: 300px;"></div>

 @endsection


 <script>
     // Access the dynamic data from the server-side
     let apartment = @json($apartment);





     // Set product information
     tt.setProductInfo("map", "1.0.0");

     // Create a map instance
     const map = tt.map({
         key: "C1hD0sgXZDUkeMEZv5sG1rcdkSZbr1dX",
         container: "map",
         center: [apartment.longitude, apartment.latitude], // Use the dynamic latitude and longitude
         zoom: 16,
     });


     // Add a marker at the specified center coordinates
     const marker = new tt.Marker({
         color: '#ff385c',
     }).setLngLat([apartment.longitude, apartment.latitude]).addTo(map);
 </script>


 <!-- map -->