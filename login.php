<?php
// Define variables and initialize with empty values
$username = "";
$username_err = $password_err = "";
session_start();

//check if the user logged in already
if(isset($_COOKIE["sid"]) && isset($_COOKIE["user"]) && isset($_SESSION["loggedin"])){
    //if yes redirect to the dashboard
    header("Location: ./transfer.php");
}

require("csrf_token.php");
//call function to generate token and assign the returned token to a variable
$token = csrf_token_gen();//this will be added to the form hidden field

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="author" content="Kalana Sankalpa (IT18145908)">

        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/login.js"></script>
    </head>
    <body>
    <div class="content">
        <div class="data">
        <span class="ftitle2">Synchronizer To<span class="stitle2">ken Pattern</span></span>
        <br /><br />
        <span class="ftitle1">Log<span class="stitle1">in</span></span>
        
        <br /><br />
        <form action="./login_check.php" method="POST" onsubmit="return do_login();">
            <table align="center">
            <tr>
            <td>
            <div class="forms">
                    <img src="images/user.png" />
                    <input type="text" placeholder="Username" name="username" id="username" value="<?php echo $username; ?>" />
                </div>
                <span class="error" id="user_err"></span>
            </td>
            </tr>

            <tr>
            <td>
                <div class="forms">
                    <img src="images/pass.png" />
                    <input type="password" placeholder="Password" name="password" id="password" />
                </div>
                <span class="error" id="pass_err"></span>
            </td>
            </tr>

            <tr>
			<td align="right">
            
            <input type="hidden" name="csrf" id="csrf" value="<?php echo $token; ?>"/>
            <button type="submit" name='sub' class="btn">Login</button>
			</form>
			<button class="btn" onclick="window.location.reload();">Refresh</button>
            </td>
            </tr>
            </table>
        </div>
    </div>
    </body>
</html>