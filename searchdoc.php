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

$sql = " SELECT * FROM docters_details ";
$result = mysqli_query($link, $sql);

if(isset($_GET['search']))
{
  $search = $_GET['search'];
  $sql = " SELECT * FROM docters_details where clinic_address LIKE '%".$search."%'";
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
	</style>
	<body style="background: linear-gradient(#73c8fb, #d4a1f3);; background-repeat: no-repeat; background-size: cover;">
    <div class="center">
      <a href="patient.php"><i style="font-size: 30px" class="material-icons white-text">home</i></a> <a href="logout.php"><i style="font-size: 30px" class="material-icons white-text">power_settings_new</i></a>
    </div>


    <div class="container">
        <!-- <img src="assets/images/logo.png"> -->
        <h1 class="center white-text"><b>MediCare+</b></h1>
        <h5 id="demo" class="center white-text"></h5>
        <br><br>

        <form class="col s12" method="GET" action="<?=$_SERVER['PHP_SELF'];?>">
            <div class="input-field col s12 offset-m2 m8 offset-l2 l8">
               <input name="search" placeholder="Search Location" id="title" type="text" class="validate">
            </div>
            <button style="border-radius: 20px" class="btn waves-effect waves-light deep-purple lighten-1" type="submit">Submit</button>
          </form>

        
        <?php 

              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_assoc($result))
              {


        ?>  

        <div class="row">
        
        

          
          <div style="background-color:white; border-radius: 40px; padding:25px 50px; text-align: justify;" class="col s12 offset-m2 m8 offset-l2 l8">




            <div class="col s3" style="background-image:url('view.php?id=<?php echo $row['did']; ?>'); background-repeat: no-repeat; background-size: contain; background-position: center; height: 165px;">
              <!-- <h4><b>Dr. Hakeem Lukka</b></h4> -->
            </div>
            <div style="padding-left: 22px" class="col s9">
              <h4 style="margin-top: 0px"><b><?php echo $row['first_name']." ".$row['last_name'] ?></b></h4>
              <p class="green-text text-lighten-1" style="margin-top: -8px; margin-bottom: 5px">Medical registration verified</p>
              <div class="col s12 m6 l12" style="padding:0;"">
                <h6 class="deep-purple-text"><b>Clinic Details:</b></h6>
                <p style="margin: 7px 0px;"><?php echo $row['clinic_address'] ?></p>
              </div>
              <div class="col s12 m6 l6" style="padding:0;">
                <h6 class="deep-purple-text"><b>Clinic's number:</b></h6>
              <p style="margin: 7px 0px;"><?php echo $row['clinic_mobile'] ?></p>
              </div>
              <div class="col s12 m6 l6" style="padding:0;">
                <h6 class="deep-purple-text"><b>Reputation points:</b></h6>
                <p style="margin: 7px 0px;"><?php echo rand(0,50) ;?></p>
              </div>
              </div>
            </div>


            

          </div>
        
          <?php } ?>

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