<?php

if(isset($_POST['register']))
{
    $userName = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $passWord = $_POST['password'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $conn = new mysqli('localhost','root','','bookhaven');
    if($conn->connect_error){
        die('Connection Failed: '.$conn->connect_error);
    }else{

        $stmt = $conn->prepare("insert into user(username,f_name,l_name,pw,user_contact,email,address) values(?,?,?,?,?,?,?)");

        $stmt->bind_param("sssssss",$userName,$firstName,$lastName,$passWord,$contact,$email,$address);
        $stmt->execute();
        
        $var = 'Registration Success!';
        $message = 'Please login to your account to place orders..';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';

        $stmt-> close();
        $conn->close();
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
        <script src="sweetalert.min.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <h1>Sign Up</h1>
            <form action="register.php" method="POST">
                <input type="text" placeholder="Username" name="username" required>
                <input type="text" placeholder="First Name" name="firstname" required>
                <input type="text" placeholder="Last Name" name="lastname" required>
                <input type="text" placeholder="Contact" name="contact" required>
                <input type="text" placeholder="Email" name="email" required>
                <input type="text" placeholder="Address" name="address" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Re-Enter Password" required>
            
            <div class="terms">
                <input type="checkbox" id="checkbox">
                <label for="checkbox">I agree to these<a href="#">Terms & Conditions</a></label>
            </div>
            <button type="submit" name="register">Sign Up</button>
            </form>
            <div class="member">
                Already have an account? <a href="login.php">
                    Login Here
                </a>
            </div>
        </div>
    </body>

</html>