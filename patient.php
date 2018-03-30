<?php
require_once 'config.php';

session_start();

if(isset($_SESSION['username']))
{
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM user_details WHERE username = '".$username."'";

  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result); 

  $first_name = $row['first_name'];
}
?>
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
	</style>
	<body style="background: linear-gradient(#73c8fb, #d4a1f3);; background-repeat: no-repeat; background-size: cover;">
    <div class="center">
      <a href="logout.php"><i style="font-size: 30px" class="material-icons white-text">power_settings_new</i></a>
    </div>
	
    <div class="container">
        <!-- <img src="assets/images/logo.png"> -->
        <h1 class="center white-text"><b>DocQ</b></h1>
        <h5 id="demo" class="center white-text"></h5>
        <br><br>
        <h4 class="center white-text"><b>Hi, <?php echo $first_name ?></b></h4>
        <h5 class="center white-text"> Select what you had like to <br>know from bellow.</h5>
        <br><br>
        <div class="row">
            <div class="col s3">
                <div class="feature">
                    <img class="center" src="assets/images/care.png">
                    <h4 style="margin-top: 0px; font-size: 1.8rem;" class="center"><a style="color:#676767"" href="awareness.php"><b>Health<br>Awareness</b></a></h4>
                </div>
            </div>
            <div class="col s3">
                <div class="feature">
                    <img class="center" src="assets/images/doctor.png">
                    <h4 style="margin-top: 0px; font-size: 1.8rem; color:#676767" class="center"><a style="color:#676767" href="searchdoc.php"><b>Search<br>Doctors</b></a></h4>
                </div>
            </div>
            <div class="col s3">
                <div class="feature">
                    <img class="center" src="assets/images/map.png">
                    <h4 style="margin-top: 0px; font-size: 1.8rem; color:#676767" class="center"><a style="color:#676767" href="map.php"><b>Nearby<br>Clinics</b></a></h4>
                </div>
            </div>
            <div class="col s3">
                <div class="feature">
                    <img class="center" src="assets/images/yoga.png">
                    <h4 style="margin-top: 0px; font-size: 1.8rem; color:#676767" class="center"><a style="color:#676767" href="fitness.php"><b>Fitness<br>Suggestions</b></a></h4>
                </div>
            </div>
        </div>
    </div>
    <br>
  <!--Import jQuery before materialize.js-->
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
  <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.js"></script>

  <script>
  $(document).ready(function(){
    var i = 0;
    var txt = 'Your personal health care assitant...';
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