<?php

  require_once('../includes/sessions.php');
  require_once('../includes/functions.php');

  session_unset();
  session_destroy();

  redirect_to("login.php");
?>
