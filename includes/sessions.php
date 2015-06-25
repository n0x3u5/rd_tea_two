<?php
 session_start();

 function session_msg() {
	if(isset($_SESSION["message"])) {
		$output = "<div class=\"message\">";
		$output .= htmlentities($_SESSION["message"]);
		$output .= "</div>";

		$_SESSION["message"] = NULL;
    //echo $output;
		return $output;
	}
 }
?>
