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

	$qid=$_GET['qid'];

	$sql2 = "SELECT * FROM question WHERE qid=".$_GET['qid'].";";
	if($result1 = mysqli_query($link, $sql2)){
		if(mysqli_num_rows($result1) > 0){
			$row1 = mysqli_fetch_array($result1);
		}
	}


	//INSERT QUESTION
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answer'])){
		$id=$row['id'];
		$answer=$_POST['answer'];
		$upload_date=date("Y/m/d");

		$sql1 = "INSERT INTO answer (qid,id,answer,upload_date) VALUES (?,?,?,?);";
		if($stmt1 = mysqli_prepare($link, $sql1)){
	        // Bind variables to the prepared statement as parameters
	        mysqli_stmt_bind_param($stmt1,"ssss",$qid,$id,$answer,$upload_date);
	        
	        // Attempt to execute the prepared statement
	        if(mysqli_stmt_execute($stmt1)){ ?>
	                <!-- <script type="text/javascript"> -->
	                    <!-- alert("Entry Successful"); -->
	                    <?php
	                    $updated_no_ans=$row1['no_ans']+1;
	                    $update_no_of_answers = "UPDATE question SET no_ans=".$updated_no_ans." WHERE qid=".$_GET['qid'].";";
						mysqli_query($link, $update_no_of_answers);
						?>
	                <!-- </script> -->
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#confirm").click(function () {
            $.ajax({
                    type: "GET",
                    url: "add_likes.php",
                    data: {
                        firstname: "Bob",
                        lastname: "Jones"
                    }
                })
                .done(function (msg) {
                    alert("Data Saved: " + msg);
                });
        });
    });
</script>



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

	</style>
	<div class="fixed-action-btn">
		<a href="#addQuestion" class="modal-trigger btn-floating btn-large deep-purple lighten-2">
		   <i class="large material-icons">mode_edit</i>
		</a>
	</div>
	<div id="addQuestion" class="modal">
	    <div class="modal-content">
	      	<form method="POST" action="answer.php?qid=<?php echo $qid; ?>" class="col s12">
		      <div class="row">
		      	<div class="col s12"><h5>Post Answer</h5></div>
		        <div class="input-field col s12">
		          <textarea name="answer" id="description" class="materialize-textarea" placeholder="Please enter your answer..." required></textarea>
		          <label class="deep-purple-text" for="description">Answer</label>
		        </div>
			    <div class="col s12" style="margin-top: 15px">
			    	<button type="submit" class="left btn waves-effect waves-white deep-purple">Post</button>
			    </div>
		      </div>
		    </form>
	    </div>
	</div>
	<nav class="doc-container deep-purple">
    <div class="nav-wrapper">
      <a href="dashboard.php" class="brand-logo">DocQ</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light modal-trigger" href="#modal1"><?php echo ($first_name)." ".($last_name) ?></a></li>
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
	  <div class="card white">
	    <div class="card-content question">
	      <div class="chip">
		    <img src="assets/images/dp.jpg" alt="Contact Person">
		    <?php
		    	$sql3 = "SELECT first_name,last_name FROM user_details WHERE id = ".$row1['id'].";";
		    	$result2 = mysqli_query($link, $sql3);
		    	$row2=mysqli_fetch_array($result2);

		    	echo $row2['first_name']." ".$row2['last_name'];
		    ?>
		  </div>
		  <p><b>Topic: </b><a class="deep-purple-text" href=""><?php echo $row1['topic']; ?></a></p>
	      <span class="card-title"><?php echo $row1['question']; ?></span>
	      <p style="font-size: 18px;"><?php echo $row1['description']; ?></p>
	      <p class="grey-text text-darken-1"><i class="material-icons">access_time</i> Asked on <?php echo $row1['upload_date']; ?></p>
	    </div>
	  </div>
      <div class="row">  
        <div class="col s12">
          <h4>Answers (<?php echo $row1['no_ans']; ?>)</h4>
      	</div>
      </div>

<?php
$sql4 = "SELECT * FROM answer WHERE qid=".$_GET['qid'].";";
if($result3 = mysqli_query($link, $sql4)){
	if(mysqli_num_rows($result3) > 0){
		while($row3 = mysqli_fetch_array($result3)){?>

  	  <div class="card white">
	    <div class="card-content question">
	      <div class="chip">
		    <img src="assets/images/dp.jpg" alt="Contact Person">
		    <?php
		    	$sql5 = "SELECT first_name,last_name FROM user_details WHERE id = ".$row3['id'].";";
		    	$result4 = mysqli_query($link, $sql5);
		    	$row4=mysqli_fetch_array($result4);

		    	echo $row4['first_name']." ".$row4['last_name'];
		    ?>
		  </div>
	      <p class="grey-text text-darken-1"><i class="material-icons">access_time</i> Answered on <?php echo $row3['upload_date']; ?></p>
	      <p style="font-size: 20px;"><?php echo $row3['answer']; ?></p>
	    </div>
	    <div class="card-action">
			<a href="add_likes_answers.php?id=<?php echo $row3['ansid']; ?>&action=like" style="color: green;">Upvotes <?php echo $row3['upvote']; ?> <i class="material-icons">check</i></a> 
			<a href="add_likes_answers.php?id=<?php echo $row3['ansid']; ?>&action=unlike" style="color: orange;">Downvotes <?php echo $row3['downvote']; ?> <i class="material-icons">close</i></a>	    
		</div>
	  </div>

<?php
		}
	}
}?>
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
	  });
	  </script>
</body>
  </html>
  </html>