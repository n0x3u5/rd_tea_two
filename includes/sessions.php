<?php
 session_start();

 // if(!isset($_SESSION['user'])) {
 //   header("Location: index.php");
 //   exit();
 //  }

 function session_msg() {
	if(isset($_SESSION["message"])) {
		$output = "<div class=\"message\">";
		$output .= htmlentities($_SESSION["message"]);
		$output .= "</div>";

		$_SESSION["message"] = NULL;
		return $output;
	}
 }

?>
