<?php
if(!empty($_GET["id"])) {
require_once 'config.php';

	switch($_GET["action"]){
		case "like":
				$sql ="UPDATE blog SET upvote = upvote + 1 WHERE bid='" . $_GET["id"] . "'";
				$result = mysqli_query($link, $sql);		
				header('Location: ' . $_SERVER['HTTP_REFERER']);					
		break;		
		case "unlike":
				$sql ="UPDATE blog SET downvote = downvote + 1 WHERE bid='" . $_GET["id"] . "'";
				$result = mysqli_query($link, $sql);
				header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;		
	}
}
?>