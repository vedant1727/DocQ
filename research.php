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


	$sql = "SELECT * from docters_details";

	$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
	  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/style.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/dashboard.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
	<body style="background-color: #f7f7f7">
	<style type="text/css">
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
	<nav class="doc-container deep-purple">
    <div class="nav-wrapper">
      <a href="dashboard.php" class="brand-logo">MediCare+</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      	<li><a class="waves-effect waves-light modal-trigger" href="dashboard.php">Home</a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="#modal1"><?php echo $first_name." ".$last_name ?></a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="logout.php">Logout</a></li>
      </ul>
    </div>
	</nav>
	<nav class="doc-container deep-purple">
	    <div class="nav-wrapper">
	      <form class="row">
	        <div class="input-field col s10 m10 l11">
	          <input id="search" type="search" class=" deep-purple lighten-2" required>
	          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
	          <i class="material-icons">close</i>
	        </div>
	        <a id="sea" class="waves-effect waves-light btn left white deep-purple-text col s2 m2 l1" type="submit" href="">Submit</a>
	      </form>
	    </div>
    </nav>
    <br><br>
    <div class="doc-container row">
		<div class="row">  
			<div class="col s12">
		  		<h4>Ongoing Researches</h4>
			</div>
		</div>


	<?php 
	
	while($row = mysqli_fetch_assoc($result))
	{

		$doctor_first = $row['first_name'];
		$doctor_last = $row['last_name'];

		$research_topic  = $row['research_title'];
		$abstract = $row['abstract'];

		$topic = $row['topic'];
		$date = $row['started'];

		?>

		<div class="card white">
	    	<div class="card-content question">
	    		<div class="chip">
			    	<img src="assets/images/dp.jpg" alt="Contact Person">
			    		<?php echo $doctor_first." ".$doctor_last ?>
				</div>
		      <h3 class="card-title"><a href=""><?php echo $research_topic; ?></a></h3>
		      <p><b>Topic: </b><a class="deep-purple-text" href=""><?php echo $topic;?></a></p>
		      <p style="font-size: 20px; height: 150px; overflow-y: hidden;"><?php echo $abstract; ?></p>
		      <p class="grey-text text-darken-1"><i class="material-icons">access_time</i> Started on Date: <?php echo $date;?></p>
	    		</div>
	    		<div class="card-action">
	    			<a href="http://avekare.net16.net/email.php?first_name=<?php echo $doctor_first ?>&last_name=<?php echo $doctor_last ?>&email=<?php $username ?>&reciever_email=rahul.raj2015@vit.ac.in" target="_blank" style="color:#673ab7" class="modal-trigger">Colaborate <i class="material-icons">note_add</i></a>
			
				</div>
	  		</div>
		<?php
	}

	?>
	</div>
  	  
    <footer class="page-footer deep-purple">
      <div class="doc-container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">MediCare+</h5>
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
        <div class="container">
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
		$(document).ready(function(){
		    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
		    $('.blogmodal').modal();
		});
	  });
	  </script>
</body>
  </html>
  </html>