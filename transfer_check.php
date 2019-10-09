<?php
session_start();

//Define variables and initialize with empty values
$csrf = $sid =  "";

//check if the post data is set correctly and not empty
if(isset($_POST["amount"]) && (isset($_POST['csrf']) && !empty($_POST['csrf'])) && (isset($_COOKIE["sid"]) && !empty($_COOKIE["sid"]))){
    //check if the session that mapped token and session id is set 
    if(isset($_SESSION["map"])){
        //split the token and the session id from the session
        $mapArr = explode ("=", $_SESSION["map"]);

        //assign them to variables
        $csrf = $mapArr[0];
        $sid = $mapArr[1];
    }

    //compare the mapped csrf token and the post csrf token
    if($csrf != $_POST["csrf"]){
        $messege = "Invalid CSRF token. <br/> Please refresh the page and try again";
    }
    //compare the mapped session id and post session id 
    elseif($sid != $_COOKIE["sid"]){
        $messege = "Invalid cookie.";
    }
    //validate entered amount
    elseif(!is_numeric($_POST["amount"])){
        $messege = "Please enter a valid amount";
    }
    //if no errors, transfer money 
    else{
        $messege = "$".$_POST["amount"]." Transfered Successfully.";
    }
}
else{
    $messege = "Invalid request.";
}
echo $messege;
//unset the session that mapped token and the sid
unset($_SESSION["map"]);
?>