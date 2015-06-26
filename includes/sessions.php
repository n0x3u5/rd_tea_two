<?php
 session_start();


  // if(!isset($_SESSION['user'])) {
  //   if($_SERVER["PHP_SELF"]!="/rd_tea_two/index.php"){
  //     header("Location: index.php");
  //     exit("Exiting");
  //   }
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
