<?php

    require_once('functions/session.php'); 
    if ($logged==false) {
         header("Location:index.php");
    }else{
        if ($_SESSION['username']=='myadmin') {
         header("Location:dashboard.php");
    }
}

if(isset($_POST['change'])){ 
    include('functions/connection.php'); 

    $user = $_SESSION['username'];

    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $addr = $_POST['addr'];
    $query = "UPDATE user SET f_name = '$name',l_name = '$lname',user_contact = '$contact',address = '$addr' WHERE username='$user'";

    $query_run = mysqli_query($con,$query);

    $var = 'Information Succesfully Updated!';
      $message = 'Your information has been changed you can now check your orders :)';

      echo '<script type="text/javascript">';
      echo "setTimeout(function () { swal('$var','$message','success')";
      echo '}, 1000);</script>';
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven</title>
    <link rel="icon" type="image/jpg" href="loqo.jpg">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href='https://iconscout.com/' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="sweetalert.min.js"></script>

</head>
<body>
   
<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class='bx bx-menu'></label>


    <a href="#" class="logo text-decoration-none">BookHaven</a>

    <nav class="navbar">
        <a href="index.php" class="text-decoration-none">home</a>
        <a href="index.php" class="text-decoration-none">about</a>
        <a href="index.php" class="text-decoration-none">products</a>
        <a href="index.php" class="text-decoration-none">review</a>
        <a href="index.php" class="text-decoration-none">contacts</a>
<?php

    require_once('functions/connection.php'); 
    require_once('functions/session.php'); 
    if ($logged==true) {
        
        echo '<a href="logout.php" class="text-decoration-none">Logout</a>';
    }
?>
    </nav>

    <div class="icons">
        <?php


    if ($logged==false) {
        
    }
    else{
?>
        <a href="addtocart.php" class='bx bxs-cart text-decoration-none' ></a>
<?php
        };
?>
        <a href="location.php" class='bx bxs-edit-location text-decoration-none' ></i></a>
        <a href="login.php" class='bx bxs-user-circle text-decoration-none' ></i></a>
    </div>

</header>

<section class="home" id="home" style="font-size: 18px;">
<?php

  $user = $_SESSION['username'];
$result = mysqli_query($con,"SELECT * FROM user WHERE username = '$user'");
$test = mysqli_fetch_array($result);

$id=$test['id'] ;
$fname=$test['f_name'];
$lname=$test['l_name'];
$addr=$test['address'];
$contact=$test['user_contact'];


?>
    <form class="row g-3" style="margin: 8%;">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Firstname</label>
    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $fname; ?>" style="font-size: 18px;" readonly>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Lastname</label>
    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $lname; ?>" style="font-size: 18px;" readonly>
  </div>
  <div class="col-md-12">
    <label for="inputText" class="form-label">Contact</label>
    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $contact; ?>" style="font-size: 18px;" readonly>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress" value="<?php echo $addr; ?>" placeholder="Veterans Ave, Zamboanga City" style="font-size: 18px;" readonly>
  </div>
  <div class="col-12">
    <button type="button" class="btn btn-primary" style="font-size: 18px;" data-bs-toggle="modal" data-bs-target="#orderModal">Edit Information</button>
  </div>
</form>

</section>
<!--footer section ends-->


<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
    <form class="row g-3" method="POST" action="location.php">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Firstname</label>
    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $fname; ?>" style="font-size: 18px;" name="name">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Lastname</label>
    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $lname; ?>" style="font-size: 18px;" name="lname">
  </div>
  <div class="col-md-12">
    <label for="inputText" class="form-label">Contact</label>
    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $contact; ?>" style="font-size: 18px;" name="contact">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress" value="<?php echo $addr; ?>" placeholder="Veterans Ave, Zamboanga City" style="font-size: 18px;" name="addr">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="change">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>