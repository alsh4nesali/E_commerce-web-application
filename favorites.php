<?php

    include('functions/connection.php'); 
    require_once('functions/session.php'); 
    if ($logged==false) {
         header("Location:index.php");
    }else{
        if ($_SESSION['username']=='myadmin') {
         header("Location:dashboard.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body{
        background: url(log.jpg) no-repeat;
        background-size: cover;
        color: rgba(8, 7, 7, 0.8);
    }
    button{
        background-color: #fff; 
        width: 80px; 
        height:30px;
    }

    button:hover{
        background-color: grey; 
    }

</style>
<body>
    <div class="favorites-container">
        <h1>My Favorites</h1>
        <div class="favorites-list">
            <!-- Example favorite item -->
<?php

    $uid = $_SESSION['uid'];

  $sql = "SELECT * FROM tbl_cart WHERE uid = $uid AND flag = '1'";
  $products = mysqli_query($con,$sql);

  while ($row = mysqli_fetch_array($products)){

  ?>
            <div class="favorite-item">
                <div class="item-thumbnail">
                    <img src="<?php echo $row['path'] ?>" alt="Product 1">
                </div>
                <div class="item-details">
                    <h2 class="item-name"><?php echo $row['product_name'] ?></h2>
                    <p class="item-description">it really hurtszzzzz</p>
                    <span class="favorite-icon">&#9825;</span>
                </div>
            </div>
<?php }; ?>

            <!-- Add more favorite items dynamically using JavaScript -->
        </div><br>
        <a href="index.php"><button >Back</button></a>
    </div>


</body>
</html>
