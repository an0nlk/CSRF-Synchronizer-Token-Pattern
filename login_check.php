<?php
//hard coded username and password
$user = "admin";
$pass = "admin";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$csrf = $sid =  "";

session_start();
//check if the csrf token session is set
if(isset($_SESSION['csrf'])){
    //assign the token to a variable
    $csrf = $_SESSION['csrf'];
}

//check if the post data is set correctly
if(isset($_POST["username"]) && (isset($_POST['csrf']) && !empty($_POST['csrf'])) && isset($_POST['csrf'])){
    //compare session csrf token with post csrf token
    if($csrf != $_POST["csrf"]){
        $password_err = "Invalid CSRF token. <br/> Please refresh the page and try again";
    }
    //if both are same
    else{
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Username cannot be empty.";
        }
        //if not assign post username to a variable
        else{
            $username = trim($_POST["username"]);
        }
    
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Password cannot be empty.";
        }
         //if not assign post password to a variable
        else{
            $password = trim($_POST["password"]);
        }
    
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            if($username == $user && $password == $pass){
                // Store data in username and session id in cookies
                setcookie("user", $username, time() + (86400 * 30), "/");
                setcookie("sid", session_id(), time() + (86400 * 30), "/");
                
                //make session for user logged in for login
                $_SESSION['loggedin'] = 1;
            }
            else{
                $password_err = "Invalid username or password.";
            }
        }
    }
    //ajax response
    header("Content-Type: application/json", true);
    echo json_encode(array("user_error" => $username_err, "pass_error" => $password_err));
	
	//unset the session that saved csrf token
	unset($_SESSION["csrf"]);
	exit;
}
else{
    echo "Invalid request.";
}