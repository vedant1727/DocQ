<?php 

require_once 'config.php';

session_start();

if(isset($_SESSION['username']))
{
  $username = $_SESSION['username'];
  $sqla = "SELECT * FROM user_details WHERE username = '".$username."'";
  $resulta = mysqli_query($link, $sqla);
  $rowa = mysqli_fetch_assoc($resulta); 

  $first_name = $rowa['first_name'];
  $last_name = $rowa['last_name'];
  $uid=$rowa['id'];

  $sel="SELECT * FROM docters_details WHERE uid='".$uid."'";
  $res=mysqli_query($link,$sel);
  $rowsel= mysqli_fetch_assoc($res);

  if($res->num_rows > 0){
    header('Location: dashboard.php');
  } else {
    // Define variables and initialize with empty values
    $username = $password = "default";
    $username_err = $password_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $liscense = $_POST['liscense'];
      $bio = $_POST['bio'];
      $experience1 = $_POST['experience1'];
      $experience2 = $_POST['experience2'];
      $experience3 = $_POST['experience3'];

      $university1 = $_POST['university1'];  
      $university2 = $_POST['university2'];
      $university3 = $_POST['university3'];

      $year_passout1 = $_POST['year_passout1'];
      $year_passout2 = $_POST['year_passout1'];
      $year_passout3 = $_POST['year_passout1'];

      $specialization1 = $_POST['specialization1'];
      $specialization2 = $_POST['specialization2'];
      $specialization3 = $_POST['specialization3'];

      $award1 = $_POST['award1'];
      $award2 = $_POST['award2'];
      $award3 = $_POST['award3'];

      $clinic_mobile = $_POST['clinic_mobile'];
      $clinic_address = $_POST['clinic_address'];
      $research_title = $_POST['research_title'];
      $abstract = $_POST['abstract'];

      $started = $_POST['started'];
      $topic = $_POST['topic'];

      $imgContent1 = null;
        
      $check1 = getimagesize($_FILES["image1"]["tmp_name"]);
      if($check1 !== false){
            $image1 = $_FILES['image1']['tmp_name'];
            $imgContent1 = addslashes(file_get_contents($image1));
      }

      if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $sql = "INSERT INTO docters_details VALUES (NULL,'$uid','$first_name','$last_name','$email','$liscense','$bio','$imgContent1','$experience1','$experience2','$experience3','$university1','$university2','$university3','$year_passout1','$year_passout2','$year_passout3','$specialization1','$specialization2','$specialization3','$award1','$award2','$award3','$clinic_mobile','$clinic_address','$research_title','$abstract','$topic','$started')";
      

      if(mysqli_query($link, $sql)){
        // echo "Records inserted successfully.";
        ?>

        <script type="text/javascript">
          alert("Records inserted successfully.");
        </script>

        <?php

        header('Location: logout.php');

      } else{
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        ?>

        <script type="text/javascript">
          alert("Something went wrong.Try Again");
        </script>

        <?php
      }
      mysqli_close($link);
    }
  }
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
      <link type="text/css" rel="stylesheet" href="assets/css/docdetails.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/style.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
	<body>
	<style type="text/css">

	</style>
	<nav class="doc-container deep-purple">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">DocQ</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light modal-trigger" href="#modal1"><?php echo $rowa['first_name']." ".$rowa['last_name']?></a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="logout.php">Logout</a></li>
      </ul>
    </div>
	</nav>
<div class="avl-container">
  	<div class="tagline">
  	  <h4>Welcome to <span>DocQ</span></h4>
  	  <h3>Join our large family of Doctors.</h3>
  	</div>
  </div>
<!--Page 1-->
  <form method="POST" action="" onsubmit="" enctype="multipart/form-data">
  <div class="row avl-container">
  <div class="form-border col s12 m10 l9">
    <h4>Personal Details</h4>
    <div class="header-underline"></div>
      <div class="row">
        <div class="input-field col s12 m6 l6">
          <p>First Name</p>
          <input id="name" name="first_name" type="text" class="validate" placeholder="Dr. Ravi" validate="name" required>
        </div>
		<div class="input-field col s12 m6 l6">
          <p>Last Name</p>
          <input id="lname" name="last_name" type="text" placeholder="Sharma" class="validate" validate="name" required>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6 l6">
          <p>E-mail</p>
          <input id="email" name="email" type="email" placeholder="abc@example.com" class="validate" validate="email" required>
        </div>
        <div class="input-field col s12 m6 l6">
          <p>Liscense Registration Number</p>
          <input id="num2" name="liscense" type="number" placeholder="Enter License number" class="validate">
        </div>
      </div>
      <div class="row">
          <div class="input-field col s12">
            <p>About yourself</p>
            <textarea id="textarea1" name="bio" placeholder="Write a bio that will be displayed on your profile.." class="materialize-textarea"></textarea>
          </div>
      </div>
      <div class="file-field input-field">
        <p>Upload Profile Picture</p>
        <div class="btn deep-purple">
          <span class="">Image</span>
          <input type="file" name="image1">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m12 l12">
          <p>Experience</p>
            <input id="profession" name="experience1" type="text" class="validate" placeholder="eg: 10 years" validate="alpha">
            <input id="profession" name="experience2" type="text" class="validate" placeholder="eg: 10 years" validate="alpha">
            <input id="profession" name="experience3" type="text" class="validate" placeholder="eg: 10 years" validate="alpha">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 m6 l6">
        	<p>Degree and University</p>
          <input name="university1" type="text" placeholder="University name" class="validate" required>
          <input name="university2" type="text" placeholder="University name" class="validate" required>
          <input name="university3" type="text" placeholder="University name" class="validate" required>
        </div>
        <div class="input-field col s12 m6 l6">
        	<p>Year Passed Out</p>
          <input name="year_passout1" type="text" placeholder="Enter year" class="validate" required>
          <input name="year_passout2" type="text" placeholder="Enter year" class="validate" required>
          <input name="year_passout3" type="text" placeholder="Enter year" class="validate" required>
        </div>        
      </div>
      <div class="row">
        <div class="input-field col s12 m6 l6">
          <p>Specializations</p>
          <input name="specialization1" type="text" placeholder="Enter specialization" class="validate" required>
          <input name="specialization2" type="text" placeholder="Enter specialization" class="validate" required>
          <input name="specialization3" type="text" placeholder="Enter specialization" class="validate" required>
        </div>
        <div class="input-field col s12 m6 l6">
          <p>Awards and Recognitions</p>
          <input name="award1" type="text" placeholder="Enter your achievement here" class="validate" required>
          <input name="award2" type="text" placeholder="Enter your achievement here" class="validate" required>
          <input name="award3" type="text" placeholder="Enter your achievement here" class="validate" required>
        </div>        
      </div>
      <div class="row">
        <div class="input-field col s12 m6 l6">
          <p>Clinic's Phone Number</p>
          <input id="num1" name="clinic_mobile" type="number" placeholder="Mobile number" class="validate" required>
        </div>
        <div class="input-field col s12 m6 l6">
          <p>Clinic's Address</p>
          <input id="num1" name="clinic_address" type="text" placeholder="Clinic Address" class="validate" validate="phone" required>
        </div>
      </div>
      <div class="row">
        <div class="col s12">  
          <p>On going Research work</p>
        </div>
        <div class="input-field col s12 m12 l12">
          <input  name="research_title" type="text" placeholder="Title" class="validate" required>
        </div>
        <div class="input-field col s12 m12 l12">
          <input  name="topic" type="text" placeholder="Topic" class="validate" required>
        </div>
        <div class="input-field col s12 m12 l12">
          <input  name="started" type="date" placeholder="Started" class="validate" required>
        </div>
        <div class="input-field col s12 m12 l12">
          <textarea  name="abstract" type="text" placeholder="Abstract" class="materialize-textarea" required></textarea>
        </div>
      </div>
  </div>
  </div>
  <div class="button-message"></div>
  	<button type="submit" class="button-center deep-purple" id="bt">SUBMIT<i class="material-icons right sub-icon">send</i></button>  
  </form>
    <footer class="page-footer deep-purple">
      <div class="doc-container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">DocQ</h5>
            <p class="grey-text text-lighten-4">A place for doctors to come together.</p>
			<i class="fa fa-facebook-official" aria-hidden="true"></i>
			<i class="fa fa-twitter-square" aria-hidden="true"></i>
			<i class="fa fa-google-plus-square" aria-hidden="true"></i>
          </div>
          <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Address</h5>
            <p>Offices at VIT Univesity</p>
          </div>
        </div>
      </div>
	  <div class="footer-copyright">
        <div class="doc-container">
        © 2017 All rights reserved
        </div>
      </div>
    </footer>
        
      <!--Import jQuery before materialize.js-->
      <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
      <script type="text/javascript" src="jquery.min.js"></script>
      <script type="text/javascript" src="assets/js/materialize.js"></script>

	  <script>
	  $(document).ready(function(){
		// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
		$('.modal').modal({
     		endingTop: '5%', // Ending top style attribute
		});
	  });
	  </script>
</body>
  </html>
  </html>