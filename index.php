<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(isset($_SESSION['user'])){
		redirect_to("update_profile.php");
	}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
				<meta name="theme-color" content="#66BB6A">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet'>
        <link type="text/css" rel="stylesheet" href="css/login_style.css" />
        <link rel="icon" href="images/logo_rdtea.png"/>
        <title>R. D. Tea | Login</title>

    </head>
    <body>
		<div class="container">
			<div id="login" class="signin-card">
			<div class="logo-image">
			<img src="images/logo_rdtea.png" alt="Logo" title="Logo" width="138">
			</div>
			<h1 class="display1">R. D. Tea Ltd.</h1>
			<!-- <p class="subhead">Hansqua Tea Garden</p> -->
				<form action="form_process_login.php" method="post" role="form">
					<div id="form-login-username" class="form-group">
						<input id="username" class="form-control" name="email" type="email" size="18" alt="login" required />
						<span class="form-highlight"></span>
						<span class="form-bar"></span>
						<label for="username" class="float-label">email</label>
					</div>
					<div id="form-login-password" class="form-group">
						<input id="passwd" class="form-control" name="password" type="password" size="18" alt="password" required>
						<span class="form-highlight"></span>
						<span class="form-bar"></span>
						<label for="password" class="float-label">password</label>
					</div>
					<div>
						<button class="btn btn-block btn-raised btn-success ripple" type="submit" name="login_submit" alt="sign in">Sign in</button>
					</div>
				</form>
			</div>
		</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		(function (window, $) {
			$(function() {
				$('.ripple').on('click', function (event) {
					var $div = $('<div/>'),
						btnOffset = $(this).offset(),
						xPos = event.pageX - btnOffset.left,
						yPos = event.pageY - btnOffset.top;
					$div.addClass('ripple-effect');
					var $ripple = $(".ripple-effect");
					$ripple.css("height", $(this).height());
					$ripple.css("width", $(this).height());
					$div.css({
						top: yPos - ($ripple.height()/2),
						left: xPos - ($ripple.width()/2),
						background: $(this).data("ripple-color")
					}).appendTo($(this));
					window.setTimeout(function(){
						$div.remove();
					}, 2000);
				});
			});
		})(window, jQuery);
		</script>
    </body>
</html>
