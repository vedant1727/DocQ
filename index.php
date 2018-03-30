<?php

require_once 'config.php';

session_start();

// Define variables and initialize with empty values
$username = $password = "default";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_username']) && isset($_POST['login_password'])){
 
    // Check if username is empty
    if(empty(trim($_POST["login_username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["login_username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['login_password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['login_password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            //Password is correct, so start a new session and save the username to the session 
                            session_start();
                            $_SESSION['username'] = $username;
                            $user_details = "SELECT * FROM user_details WHERE username = '".$username."'";
                            $result_user = mysqli_query($link, $user_details);
                            $row_user = mysqli_fetch_assoc($result_user);
                            if ($row_user['type']=='doctor') {
                                header("location: docdetails.php");
                            } else {
                                header("location: patient.php");
                            }
                            
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                            ?>
                                <script type="text/javascript">
                                	alert('The password you entered was not valid.');
                                </script>
                            <?php
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                    ?>
                        <script type="text/javascript">
                        	alert('No account found with that username.');
                        </script>
                    <?php

                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                ?>
                    <script type="text/javascript">
                       	alert('No account found with that username.');
                    </script>
                <?php
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_password']) && isset($_POST['register_username'])){
 
    // Validate username
    if(empty(trim($_POST["register_username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["register_username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["register_username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['register_password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['register_password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['register_password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["register_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['register_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
    	$first_name = $_POST['first_name'];
    	$last_name= $_POST['last_name'];
    	$type = $_POST['type'];

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $sql1 = "INSERT INTO user_details VALUES (null,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                
            } else{
                ?>
                    <script type="text/javascript">
                    	alert("Something went wrong. Please try again later.");
                    </script>
                <?php

            }
        }

        if($stmt1 = mysqli_prepare($link, $sql1)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1,"sssss",$first_name,$last_name,$param_username, $param_password,$type);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
		
            if(mysqli_stmt_execute($stmt1)){ ?>
                    <script type="text/javascript">
                        alert("Successfully created new account");
                        <?php
                            header("location: logout.php");
                            
                         ?>

                    </script>
            <?php } 
            else{ ?>
                <script type="text/javascript">
                    alert("Something went wrong. Please try again later.");
                </script>
                <?php
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt1);
    }
    
    // Close connection
    mysqli_close($link);
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
		input[type=text]:not(.browser-default):focus:not([readonly]){
			border-bottom: 1px solid #673ab7!important;
		    -webkit-box-shadow: 0 1px 0 0 #673ab7!important;
		}
	</style>
	<body>
	<nav class="doc-container deep-purple">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">DocQ</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light modal-trigger" href="#modal1">Login</a></li>
        <li><a class="waves-effect waves-light modal-trigger" href="#modal2">Signup</a></li>
      </ul>
    </div>
	</nav>
	<div class="lgn_m">
		<div id="modal1" class="modal">
	    <div class="modal-content">
		  <div class="row">
		    <form method="POST" action="index.php" class="col s12 m12 l12">
			  <div class="row">
			  	<h5>Login</h5> 
		        <div class="input-field col s12">
		          <input name="login_username" id="email" type="email" class="validate" required>
		          <label for="email">Email</label>
		        </div>
		      </div>
		      <div class="row">
		        <div class="input-field col s12">
		          <input  name="login_password" id="login_password" type="password" class="validate" required>
		          <label for="password">Password</label>
		        </div>
		      </div>
			  <p>Not a member? Click <a class="modal-trigger" id="internal_m1" href="#modal2">here to Signup</a></p>   
		      <button type="submit" class="waves-effect waves-light btn left deep-purple">Submit</button>
			</form>
		  </div>
		</div>
	  </div>
  </div>
  <div id="modal2" class="modal">
    <div class="modal-content">
	  <div class="row">
	    <form method="POST" action="index.php" class="col s12">
	      <div class="row">
	      	<h5>Sign Up</h5>
	        <div class="input-field col s12 m6 l6">
	          <input name="first_name" id="first_name" type="text" class="validate" required>
	          <label for="first_name">First Name</label>
	        </div>
	        <div name="last_name" class="input-field col s12 m6 l6">
	          <input name="last_name" id="last_name" type="text" class="validate" required>
	          <label for="last_name">Last Name</label>
	        </div>
			<div class="input-field col s12 m12 l12">
	          <input name="register_username" id="email" type="email" class="validate" required>
	          <label for="email">Email</label>
	        </div>
			<div class="input-field col s12 m12 l12">
	          <input name="register_password" id="password" type="password" class="validate" required>
	          <label for="password">Password</label>
	        </div>
	        <p>Select your account type:</p>
			<p class="col s12 m4 l2">
		      <input name="type" type="radio" id="test1" value="patient"/>
		      <label for="test1">Patient</label>
		    </p>
		    <p class="col s12 m4 l2">
		      <input name="type" type="radio" id="test2" value="doctor"/>
		      <label for="test2">Doctor</label>
		    </p>
			<p class="col s12 m12 l12">Already a member? Click <a class="modal-trigger" id="internal_m" href="#modal1">here to Login</a></p>
	      </div>
	      <div class="modal-footer">
			<!-- <a type="submit" class="waves-effect waves-light btn left deep-purple">Submit</a> -->
	        <button class="waves-effect waves-light btn" type="submit">Submit</button>
	      </div>
		</form>
	  </div>
  </div>
  </div>
    <div class="doc-container bg-img">
      <div class="row">
        <div class="col s12 m6 l8 tagline">
              <h1><b>A place for <span>doctors</span> to come <span>together.</span></b></h1>
			  <h5 style="margin-top:0px"><b>Click <a class="modal-trigger" href="#modal2"><span>here</span></a> to join us.</b></h5>
			  <div class="col s7" style="padding-left:0px">
				<h5><b>Why join us?</b></h5>
				<p>DocQ is a platform for doctors to interact and ask questions, and get replies from qualified and experienced professionals.</p>
			  </div>
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
	$('#modal1').modal();
	$('#modal2').modal();
	$('#internal_m').click(function(){
		$('#modal2').modal('close');
	});
	$('#internal_m1').click(function(){
		$('#modal1').modal('close');
	});
  });
  </script>
</body>
</html>
</html>
