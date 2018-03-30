<?php
if(!empty($_GET["id"])) {
require_once 'config.php';

	switch($_GET["action"]){
		case "like":
				$sql ="UPDATE answer SET upvote = upvote + 1 WHERE ansid='" . $_GET["id"] . "'";
				$result = mysqli_query($link, $sql);		
				echo "Like";
				header('Location: ' . $_SERVER['HTTP_REFERER']);					
		break;		
		case "unlike":
				$sql ="UPDATE answer SET downvote = downvote + 1 WHERE ansid='" . $_GET["id"] . "'";
				$result = mysqli_query($link, $sql);
				echo "unlike";
				header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;		
	}
}
?>