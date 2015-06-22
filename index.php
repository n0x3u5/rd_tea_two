<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet'>
        <link type="text/css" rel="stylesheet" href="css/login_style.css" />
        <link rel="icon" href="images/logo_rdtea.png"/>
        <title>
            R.D. Tea | Login
        </title>

    </head>
    <body>
        <div class="container">
            <div id="logo">
                <img src="images/logo_rdtea.png"/><br/>
            </div>
            <div id="login-form">
                <input type="radio" checked id="login" name="switch" class="hide">
                <div>
                    <ul class="form-header">
                        <li>
                            <label for="login">
                                <i class="glyphicon glyphicon-lock"></i>
                                LOGIN
                            </label>
                        </li>
                    </ul>
                </div>
                    <div class="login">
                        <form action="form_process_login.php" method="post">
                            <ul class="ul-list">
                                <br/><br/>
                                <li>
                                    <input type="email" name="email" required class="input" placeholder="Email">
                                    <span class="icon" style="margin-left: -4px"><i class="glyphicon glyphicon glyphicon-user"></i></span>
                                </li>
                                <li>
                                    <input type="password" name="password" required class="input" placeholder="Password">
                                    <span class="icon" style="margin-left: -4px"><i class="glyphicon glyphicon-asterisk"></i></span>
                                </li>
                                <li>
                                    <span class="remember">
                                        <input type="checkbox" id="check">
                                        <label for="check">Remember Me</label>
                                    </span>
                                    <span class="remember">
                                        <a href="#">Forgot password?</a>
                                    </span>
                                </li>
                                <li>
                                    <input type="submit" name="submit" value="SIGN IN" class="btn">
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>
