<?php 
require_once("functions/connection.php");
require_once("functions/session.php");

if(isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == true)
    {
        if ($_SESSION['account']=="user") {
                header("Location:index.php");
            }
        elseif ($_SESSION['account']=="admin") {
                header("Location:dashboard.php");
            }
    }  
    else  {
        header("Location:../index.php");
      }  
}

if(isset($_POST['login_submit'])) {
    if(!(isset($_POST['username']))) {
        if(!(isset($_POST['pass']))) {
            location('index.php');    
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF=8">
        <title>Login and Signup form</title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body>
        <div class="wrapper">
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="pass">
                <div class="recover">
                    <a href="#">Forgot Password?</a>
                </div>
            <button type="submit" name="login_submit">Login</button>
            </form>
            <div class="member">
                You have no Account? <a href="register.php">
                    Register Now
                </a>
            </div>
        </div>
    </body>

</html>