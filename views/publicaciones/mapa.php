<?php ?>
    <div id="map" style="width:100%; height:200px;"></div>
    <script>
       // Note: This example requires that you consent to location sharing when
       // prompted by your browser. If you see the error "The Geolocation service
       // failed.", it means you probably did not give permission for the browser to
       // locate you.

      function initMap() {
         var map = new google.maps.Map(document.getElementById('map'), {
           center: {lat: -34.397, lng: 150.644},
           zoom: 18
         });
         var infoWindow = new google.maps.InfoWindow({map: map});

         // Try HTML5 geolocation.
         if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(function(position) {
             var pos = {
               lat: 36.779997099999996,
               lng: -6.357195399999999//position.coords.longitude
             };

             infoWindow.setPosition(pos);
             infoWindow.setContent('Es Aquí!.');
             map.setCenter(pos);

             /*console.log(pos.lat);
             console.log(pos.lng);*/
           }, function() {
             handleLocationError(true, infoWindow, map.getCenter());
           });
         } else {
           // Browser doesn't support Geolocation
           handleLocationError(false, infoWindow, map.getCenter());
         }
       }

       function handleLocationError(browserHasGeolocation, infoWindow, pos) {
         infoWindow.setPosition(pos);
         infoWindow.setContent(browserHasGeolocation ?
                               'Error: The Geolocation service failed.' :
                               'Error: Your browser doesn\'t support geolocation.');
       }/*
       var options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
            };

            function success(pos) {
            var crd = pos.coords;

            console.log('Your current position is:');
            console.log('Latitude : ' + crd.latitude);
            console.log('Longitude: ' + crd.longitude);
            console.log('More or less ' + crd.accuracy + ' meters.');
            };

            function error(err) {
                console.warn('ERROR(' + err.code + '): ' + err.message);
                if(err.code == 1) {
                    alert("dated save deny")
                }
                else {alert("non dated save deny")}
            };

            navigator.geolocation.getCurrentPosition(success, error, options);*/

     </script>
     <script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHvxtC6tuK72E_ZcWHcyYQzYxqhZzYsbk&callback=initMap">
     </script>
