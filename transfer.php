<?php
session_start();

// Define variables and initialize with empty values
$messege = "";
$loggedin = 0;

//check if the user is logged in successfully
if(isset($_COOKIE["sid"]) && isset($_COOKIE["user"]) && isset($_SESSION["loggedin"])){
    $loggedin = 1;
    //get username from the cookie
    $username = $_COOKIE["user"];
    //change button
    $action = "./logout.php";
    $button = "Logout";

    //show success message
    $messege = "User logged in Successfully.<br /> Welcome <i>".$username."</i>";
    
}
//if the user not logged in
else{
    $messege = "not logged in";

    //change button
    $action = "./login.php";
    $button = "Login";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="UTF-8">
        <meta name="author" content="Kalana Sankalpa (IT18145908)">

        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/transfer.js"></script>
        <script>
            //generate csrf token
            $.ajax({
                url:'csrf_token.php',
                type:'POST',
                data:{
                    token_gen:"transfer"
                },
                success:function(response) {
                    //get the csrf token from ajax response and add it in a hidden field
                    document.getElementById("csrf").value = response.token;
                }
            });
        </script>
    </head>
    <body>
    <div class="content">
        <div class="data">
            <span class="ftitle1">Dash<span class="stitle1">board</span></span>
            <br />
            <p id="msg" style="font-size:30px;"><?php echo $messege; ?></p>
            <?php if($loggedin == 1){ ?>
            <form action="./transfer_check.php" method="POST" onsubmit="return do_transfer();">
            <table align="center">
            <tr>
            <td colspan="3">
            <span>Enter amount to transfer:</span>
            <div class="forms">
                    <img src="images/dollor.png" />
                    <input type="text" placeholder="100" name="amount" id="amount" value="" />
                </div>
                <span class="error" id="user_err"></span>
            </td>
            </tr>
            <tr>
            <td>
            <input type="hidden" name="csrf" id="csrf" value=""/>
            <button type="submit" class="btn">Transfer</button>
            </form>
            </td>
            <td>
            <button class="btn" onclick="window.location.reload();">Refresh</button>
            </td>
            <td>
            <?php }?>
            <form action = "<?php echo $action ?>">
                <button type="submit" class="btn"><?php echo $button ?></button>
            </form>
            </td>
            </tr>
            </table>
            
        </div>
    </div>
    </body>
</html>