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
  $last_name = $row['last_name'];
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
      <a href="patient.php"><i style="font-size: 30px" class="material-icons white-text">home</i></a> <a href="logout.php"><i style="font-size: 30px" class="material-icons white-text">power_settings_new</i></a>
    </div>
    <div class="container">
        <!-- <img src="assets/images/logo.png"> -->
        <h1 class="center white-text"><b>DocQ</b></h1>
        <h5 id="demo" class="center white-text"></h5>
        <br><br>

        <?php
        $sql1 = "SELECT * FROM blog WHERE topic='General Health'";
        if($result1 = mysqli_query($link, $sql1)){
          if(mysqli_num_rows($result1) > 0){
            while($row1 = mysqli_fetch_array($result1))
            {

              ?>

              <div class="row">
                <div style="background-color:white; border-radius: 40px; padding:25px 50px; text-align: justify;" class="col s12 offset-m2 m8 offset-l2 l8">
                  <div class="center">

                <?php
                  $sql2 = "SELECT first_name,last_name FROM user_details WHERE id = ".$row1['id'].";";
                  $result2 = mysqli_query($link, $sql2);
                  $row2=mysqli_fetch_array($result2);
            ?>

              <div class="chip">
              <?php echo $row2['first_name']." ".$row2['last_name']; ?>

              </div>
            </div>
            <h4 class="center"><b><?php echo $row1['title'];  ?></b></h4>
            <p style="line-height: 1.6; font-size: 16px"><?php echo $row1['blog']; ?></p>
          </div>
        </div>

        <?php }}} ?>

    </div>
    <br>
  <!--Import jQuery before materialize.js-->
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
  <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.js"></script>

  <script>
  $(document).ready(function(){
    var i = 0;
    var txt = 'Here are some articals by doctors...';
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