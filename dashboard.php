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
	$uid = $row['id'];

	$username = $_SESSION['username'];
	$querry = "SELECT * FROM docters_details WHERE email = '".$username."'";

	$resultxx = mysqli_query($link, $querry);
	$rowxx = mysqli_fetch_assoc($resultxx);

	//INSERT QUESTION
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question']) && isset($_POST['description']) && isset($_POST['topic'])){
		$id=$row['id'];
		$username=$row['username'];
		$question=$_POST['question'];
		$description=$_POST['description'];
		$topic=$_POST['topic'];
		$upload_date=date("Y/m/d");

		$sql1 = "INSERT INTO question (id,username,question,description,topic,upload_date) VALUES (?,?,?,?,?,?)";
		if($stmt1 = mysqli_prepare($link, $sql1)){
	        // Bind variables to the prepared statement as parameters
	        mysqli_stmt_bind_param($stmt1,"ssssss",$id,$username,$question,$description,$topic,$upload_date);
	        
	        // Attempt to execute the prepared statement
	        if(mysqli_stmt_execute($stmt1)){ ?>
	                <script type="text/javascript">
	                    alert("Entry Successful");
	                    window.location = "dashboard.php";
	                </script>
	        <?php } else{ ?>
	            <script type="text/javascript">
	                alert("Something went wrong. Please try again later.");
	            </script>
	            <?php
	        }
	    }
	    mysqli_stmt_close($stmt1);
	}
}

?>


<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

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
	<body style="background-color: #f7f7f7">
	<style type="text/css">

	</style>
	<div class="fixed-action-btn">
		<a href="#addQuestion" class="modal-trigger btn-floating btn-large deep-purple lighten-2">
		   <i class="large material-icons">mode_edit</i>
		</a>
	</div>
	<div id="addQuestion" class="modal">
	    <div class="modal-content">
	      	<form method="POST" action="dashboard.php" class="col s12">
		      <div class="row">
		      	<div class="col s12"><h5>Add your question.</h5></div>
		        <div class="input-field col s12">
		          <input name="question" placeholder="Enter your Question.." id="question" type="text" class="validate" required>
		          <label class="deep-purple-text" for="question">Question</label>
		        </div>
		        <div class="input-field col s12">
		          <textarea name="description" id="description" class="materialize-textarea" placeholder="Enter details about your question or case..." required></textarea>
		          <label class="deep-purple-text" for="description">Description</label>
		        </div>
		        <div class="col s12"><h6 class="deep-purple-text">Select a Topic</h6></div>
		        <div class="col s12">
		        	<p class="col s12 m4 l3">
				      <input name="topic" type="radio" id="neurolog"  value="General Health" />
				      <label for="neurolog">General Health</label>
				    </p>
			        <p class="col s12 m4 l3">
				      <input name="topic" type="radio" id="cardiology"  value="Cardiology" />
				      <label for="cardiology">Cardiology</label>
				    </p>
				    <p class="col s12 m4 l3">
				      <input name="topic" type="radio" id="neurology" value="Neurology" />
				      <label for="neurology">Neurology</label>
				    </p>
				    <p class="col s12 m4 l3">
				      <input name="topic" type="radio" id="Haematology"   value="Haematology" />
				      <label for="Haematology">Haematology</label>
				    </p>
			    </div>
			    <div class="col s12" style="margin-top: 15px">
			    	<button type="submit" class="left btn waves-effect waves-white deep-purple">Submit</button>
			    </div>
		      </div>
		    </form>
	    </div>
	</div>
	<nav class="doc-container deep-purple">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">DocQ</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      	<li><a class="waves-effect waves-light" href="research.php">Ongoing Research</a></li>
      	<li><a href="writeblog.php">Write Blog</a></li>
        <li>
        	<a class="waves-effect waves-light modal-trigger" href="profile.php?id=<?php echo $rowxx['did'] ?>">
        	<?php echo $first_name." ".$last_name ?>
        	</a>
        </li>
        <li><a class="waves-effect waves-light modal-trigger" href="logout.php">Logout</a></li>
      </ul>
    </div>
	</nav>
	<nav class="doc-container deep-purple">
	    <div class="nav-wrapper">
	      <form class="row">
	        <div class="input-field col s10 m10 l11">
	          <input id="search" placeholder="Search questions here.." type="search" class=" deep-purple lighten-2" required>
	          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
	          <i class="material-icons">close</i>
	        </div>
	        <button id="sea" class="waves-effect waves-light btn left white deep-purple-text col s2 m2 l1" type="submit">Search</button>
	      </form>
	    </div>
    </nav>
    <div class="doc-container row">
    	<div class="col s12 m8 l7">
    		<h5 class="deep-purple-text">Top Questions</h5>

<?php
$sql2 = "SELECT * FROM question";
if($result1 = mysqli_query($link, $sql2)){
	if(mysqli_num_rows($result1) > 0){
		while($row1 = mysqli_fetch_array($result1)){?>

			<div class="card white">
	            <div class="card-content question">
	              <div class="chip">
	              	<?php
	              		$x=$row1['id'];
						$querry1 = "SELECT * FROM docters_details WHERE uid = '".$x."'";
						$resultx = mysqli_query($link, $querry1);
						$rowx = mysqli_fetch_assoc($resultx);
	              	?>
				    <img src="view.php?id=<?php echo $rowx['did'] ?>" alt="Contact Person">
				    <a style="color: black" href="profile.php?id=<?php echo $rowx['did'] ?>">
					    <?php
					    	echo $rowx['first_name']." ".$rowx['last_name'];
					    ?>
					</a>
				  </div>
	              <span class="card-title">
	              	<a href="answer.php?qid=<?php echo $row1['qid']; ?>">
	              		<?php echo $row1['question']; ?>
	              	</a>
	              </span>
	              <p><b>Topic: </b><a class="deep-purple-text" href=""><?php echo $row1['topic']; ?></a></p>
	              <p class="grey-text text-darken-1"><i class="material-icons">access_time</i> Uploaded on <?php echo $row1['upload_date']; ?></p>
	            </div>
	            <div class="card-action">
	              <a href="answer.php?qid=<?php echo $row1['qid']; ?>" class="deep-purple-text"><i class="material-icons">question_answer</i><?php echo $row1['no_ans']; ?> Answers</a>
	            </div>
            </div>
<?php
		}
	}
}?>
            


    	</div>
    	<div class="col s12 m4 l5">
    		<h5 class="deep-purple-text">Blogs</h5>

<?php
$sql4 = "SELECT * FROM blog";
if($result3 = mysqli_query($link, $sql4)){
	if(mysqli_num_rows($result3) > 0){
		while($row3 = mysqli_fetch_array($result3)){?>
    		<div class="card">
	            <div class="card-content blog">
	              <div class="chip">
	              	<?php
	              		$y=$row3['id'];
						$querryq = "SELECT * FROM docters_details WHERE uid = '".$y."'";
						$resulty = mysqli_query($link, $querryq);
						$rowy = mysqli_fetch_assoc($resulty);
	              	?>
				    <img src="view.php?id=<?php echo $rowy['did'] ?>" alt="Contact Person">
				    <a style="color: black" href="profile.php?id=<?php echo $rowy['did'] ?>">
				    <?php
				    	echo $rowy['first_name']." ".$rowy['last_name'];
				    ?>
					</a>
				  </div>
	              <span class="card-title"><a href="blog.php?bid=<?php echo $row3['bid']?>"><?php echo $row3['title']; ?></a></span>
	              <p><b>Topic: </b><a class="deep-purple-text" href=""><?php echo $row3['topic']; ?></a></p>
	              <p class="grey-text text-darken-1"><i class="material-icons">access_time</i> Uploaded on <?php echo $row3['upload_date']; ?></p>
	            </div>
	            <div class="card-action">
	              <a href="blog.php?bid=<?php echo $row3['bid']?>" class="deep-purple-text"><i class="material-icons">remove_red_eye</i><?php echo $row3['upvote']." upvotes"; ?></a>
	            </div>
            </div>
<?php
		}
	}
}?>

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