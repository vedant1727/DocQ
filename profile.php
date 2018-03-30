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

if(isset($_GET['id']))
{
	$id =  $_GET['id'];
	$sql = "SELECT * FROM docters_details WHERE did = '".$id."'";
	
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	$f_name = $row['first_name'];
	$l_name = $row['last_name'];
	$email = $row['email'];
	$liscense = $row['liscense'];
	$bio = $row['bio'];
	$image1 = $row['image1'];
	$experience1 = $row['experience1'];
	$experience2 = $row['experience2'];
	$experience3 = $row['experience3'];
	$university1 = $row['university1'];
	$university2 = $row['university2'];
	$university3 = $row['university3'];
	$year_passout1 = $row['year_passout1'];
	$year_passout2 = $row['year_passout2'];
	$year_passout3 = $row['year_passout3'];
	$specialization1 = $row['specialization1'];
	$specialization2 = $row['specialization2'];
	$specialization3 = $row['specialization3'];
	$award1 = $row['award1'];
	$award2 = $row['award2'];
	$award3 = $row['award3'];
	$clinic_mobile = $row['clinic_mobile'];
	$clinic_address = $row['clinic_address'];
	$research_title = $row['research_title'];
	$abstract = $row['abstract'];
}
else
{
	echo "Please check for a valid doctor :-) ";
}

?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
	  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/style.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/dashboard.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
	<body>
	<style type="text/css">

	</style>
	<div class="fixed-action-btn">
		<a href="#addQuestion" class="modal-trigger btn-floating btn-large deep-purple lighten-2">
		   <i class="large material-icons">mode_edit</i>
		</a>
	</div>
	<nav class="doc-container deep-purple">
    <div class="nav-wrapper">
      <a href="dashboard.php" class="brand-logo">DocQ</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      	<li><a href="writeblog.php">Write Blog</a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="#modal1"><?php echo ($first_name)." ".($last_name) ?></a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="logout.php">Logout</a></li>
      </ul>
    </div>
	</nav>

    <div class="container">
	    <div class="row">
	    	<br>
	      	<div class="col s3" style='background-image:url("view.php?id=<?php echo $id ?>"); background-repeat: no-repeat; background-size: contain; background-position: center; height: 165px;'>
	      		
	      	</div>
	      	<div class="col s9">
	      		<h4><b><?php echo $f_name." ".$l_name ?></b></h4>
	      		<p class="green-text text-lighten-1" style="margin-top: -8px; margin-bottom: 5px">Medical registration verified</p>
	      		<div class="col s12 m6 l6" style="padding:0;"">
	      			<h6 class="deep-purple-text"><b>Clinic Details:</b></h6>
	      			<p><?php echo $clinic_address ?></p>
	      		</div>
	      		<div class="col s12 m3 l3" style="padding:0;">
	      			<h6 class="deep-purple-text"><b>Clinic's number:</b></h6>
	      		<p><?php echo $clinic_mobile; ?></p>
	      		</div>
	      		<div class="col s12 m3 l3" style="padding:0;">
	      			<h6 class="deep-purple-text"><b>Reputation Points:</b></h6>
	      		<p><b><?php echo rand(0,50); ?></b></p>
	      		</div>
	      	</div>
	    </div>
	    <div class="row">
		    <div class="col s12 m12 l12">
		    	<h5 class="deep-purple-text"><b>About</b></h5>
		    	<p><?php echo $bio?></p>
		    </div>
		    <div class="col s12 m6 l6">
		    	<h5 class="deep-purple-text"><b>Education</b></h5>
		    	<ul style="padding-left: 20px;">
		    		<li style="list-style-type: square;"><?php echo $university1 ?></li>
		    		<li style="list-style-type: square;"><?php echo $university2 ?></li>
		    		<li style="list-style-type: square;"><?php echo $university3 ?></li>
		    	</ul>
	    	</div>
	    	<div class="col s12 m6 l6">
		    	<h5 class="deep-purple-text"><b>Specializations</b></h5>
		    	<ul style="padding-left: 20px;">
		    		<li style="list-style-type: square;"><?php echo $specialization1 ?></li>
		    		<li style="list-style-type: square;"><?php echo $specialization2 ?></li>
		    		<li style="list-style-type: square;"><?php echo $specialization2 ?></li>
		    	</ul>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col s12 m6 l6">
		    	<h5 class="deep-purple-text"><b>Experience</b></h5>
		    	<ul style="padding-left: 20px;">
		    		<li style="list-style-type: square;"><?php echo $experience1 ?></li>
		    		<li style="list-style-type: square;"><?php echo $experience2 ?></li>
		    		<li style="list-style-type: square;"><?php echo $experience3 ?></li>
		    	</ul>
	    	</div>
	    	<div class="col s12 m6 l6">
		    	<h5 class="deep-purple-text"><b>Awards and Recognitions</b></h5>
		    	<ul style="padding-left: 20px;">
		    		<li style="list-style-type: square;"><?php echo $award1 ?></li>
		    		<li style="list-style-type: square;"><?php echo $award2 ?></li>
		    		<li style="list-style-type: square;"><?php echo $award3 ?></li>
		    	</ul>
	    	</div>
	    	<div class="col s12 m12 l12">
		    	<h5 class="deep-purple-text"><b>Ongoing Reseach</b></h5>
		    	<h5> <?php echo $research_title ?></h5>
		    	<p>  <?php echo $abstract ?></p>
	    	</div>
	    </div>
    </div>
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