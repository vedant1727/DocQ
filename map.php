<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
	  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/style.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <style type="text/css">
		.feature{
            border-radius: 100%;
            background-color:white;
            height:200px !important;
            width: 200px !important;
        }

        .feature:hover{
            height: 105px;
            width: 105px;
        }
        /* label underline focus color */
     .input-field input[type=text]:focus {
       border-bottom: 0px solid #000;
       box-shadow: 0 0px 0 0 #000;
     }
     input[type=text]:not(.browser-default){
       border-radius: 22px !important;
       border: 1px solid #cecbcb !important;
       background-color: white;
       padding-left: 15px;
     }
     textarea.materialize-textarea{
       border-radius: 22px !important;
       border: 1px solid #cecbcb !important;
       background-color: white;
       min-height: 5rem!important;
       padding-left: 15px;
     }
     #map {
        height: 500px;
        margin: 10px auto;
        width: 800px;
      }

	</style>
  <script type="text/javascript">
      var map;
      function initMap() {
        if (navigator.geolocation) {
          try {
            navigator.geolocation.getCurrentPosition(function(position) {
              var myLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              setPos(myLocation);
            });
          } catch (err) {
            var myLocation = {
              lat: 23.8701334,
              lng: 90.2713944
            };
            setPos(myLocation);
          }
        } else {
          var myLocation = {
            lat: 23.8701334,
            lng: 90.2713944
          };
          setPos(myLocation);
        }
      }

      function setPos(myLocation) {
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLocation,
          zoom: 10
        });

        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: myLocation,
          radius: 4000,
          types: ['hospital']
        }, processResults);

      }

      function processResults(results, status, pagination) {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
          return;
        } else {
          createMarkers(results);

        }
      }

      function createMarkers(places) {
        var bounds = new google.maps.LatLngBounds();
        var placesList = document.getElementById('places');

        for (var i = 0, place; place = places[i]; i++) {
          var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };

          var marker = new google.maps.Marker({
            map: map,
            icon: image,
            title: place.name,
            animation: google.maps.Animation.DROP,
            position: place.geometry.location
          });

          bounds.extend(place.geometry.location);
        }
        map.fitBounds(bounds);
      }
  </script>
	<body style="background: linear-gradient(#73c8fb, #d4a1f3);; background-repeat: no-repeat; background-size: cover;">
    <div class="center">
      <a href="patient.php"><i style="font-size: 30px" class="material-icons white-text">home</i></a> <a href="logout.php"><i style="font-size: 30px" class="material-icons white-text">power_settings_new</i></a>
    </div>
    <div class="container">
        <!-- <img src="assets/images/logo.png"> -->
        <h1 class="center white-text"><b>DocQ</b></h1>
        <h5 id="demo" class="center white-text"></h5>
        <br><br>
        <div class="row">
            <div id="map"></div>
        </div>
    </div>
    <br>
  <!--Import jQuery before materialize.js-->
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
  <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuBzeYkYimIquGG5KkIcB6vFmtHMUzDFo&signed_in=true&libraries=places&callback=initMap" async defer></script>
  <script>
  $(document).ready(function(){
    var i = 0;
    var txt = 'Here are some nearby Health Centers..';
    var speed = 100;

    function typeWriter() {
      if (i < txt.length) {
        document.getElementById("demo").innerHTML += txt.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
      }
    }

    typeWriter();
  });
  </script>
</body>
</html>
</html>