<?php
//genarating CSRF Token
// Ref : https://www.thecodedeveloper.com/generate-random-alphanumeric-string-with-php/

//generate token for money transfer
if(isset($_POST['token_gen'])){
    //check if the token for money transfer
    if($_POST['token_gen'] == "transfer"){
        //call function to generate token
        $token = csrf_token_gen();
    
        //call function to map CSRF Token with Session ID
        csrf_map($token);
    }
    //else
    else{
        $token = "Invalid request";
    }
    //ajax response
    header("Content-Type: application/json", true);
    echo json_encode(array("token" => $token));
    exit;
}

//function to generate csrf token
function csrf_token_gen(){
    //generate csrf token
    $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);

    //save the csrf token in a session
    $_SESSION['csrf'] = $token;

    //return the csrf token
    return $token;
}

//map CSRF Token with Session ID
function csrf_map($token){
    session_start();

    //check if the session id is set
    if(isset($_COOKIE["sid"])){
        //get session id from cookie
        $sid = $_COOKIE["sid"];

        //save mapped token and session id in a session
        $_SESSION["map"] = $token."=".$sid;
    }
}
?>