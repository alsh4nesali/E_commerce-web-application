<?php

    require_once('functions/session.php');
        require_once('functions/session.php'); 
    if ($logged==false) {

    }else{
        if ($_SESSION['username']=='myadmin') {
         header("Location:dashboard.php");
    }
    } 
    
    
    include 'functions/connection.php';

if(isset($_POST['addCart'])){
      
        $name = $_POST['p_name'];
        $cost = $_POST['p_price'];
        $desc = $_POST['p_desc'];
        $uid = $_POST['uid'];

        // Check if the product is already added to favorites for the user
    // Check if the product is already added to cart for the user
        $result = mysqli_query($con, "SELECT * FROM tbl_cart WHERE product_name = '$name' AND uid = '$uid'");
        $count = mysqli_num_rows($result);

        if($count > 0) {
        $sql="UPDATE tbl_cart SET qty = qty + 1 WHERE product_name = '$name'";
        $result = mysqli_query($con,$sql);

        $sql="UPDATE tbl_products SET product_qty = product_qty - 1 WHERE product_name = '$name'";
        $result = mysqli_query($con,$sql);

        $var = 'Item Added!';
        $message = 'Please check your cart!';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';
       



        }else{
        $sql="INSERT INTO `tbl_cart`(`product_name`,`product_price`,`product_description`,`uid`) VALUES ('$name','$cost','$desc','$uid')";

        $result = mysqli_query($con,$sql);

        $var = 'Item Added!';
        $message = 'Please check your cart!';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';
    }

}

if(isset($_POST['addFavs'])){
      
    $name = $_POST['p_name'];
    $cost = $_POST['p_price'];
    $desc = $_POST['p_desc'];
    $uid = $_POST['uid'];
    $path = $_POST['img'];
    $flag = 1;
    $fav = 1;

    // Check if the product is already added to favorites for the user
    $result = mysqli_query($con, "SELECT * FROM tbl_cart WHERE product_name = '$name' AND uid = '$uid'");
    $count = mysqli_num_rows($result);

    if($count > 0) {
        echo "<script>
        alert('Already added to Favorites!!'); 
        window.location.href='index.php';
        </script>";
    } else {
        // Insert the product into favorites
        $sql = "INSERT INTO `tbl_cart`(`product_name`,`product_price`,`product_description`,`uid`,`flag`,`path`,`fav`) 
                VALUES ('$name','$cost','$desc','$uid','$flag','$path','$fav')";
        $result = mysqli_query($con, $sql);
        echo "<script>
        window.location.href='favorites.php';
        </script>";
    }
}


if(isset($_POST['addStation'])){
      
        $name = $_POST['p_name'];
        $cost = $_POST['p_price'];
        $desc = $_POST['p_desc'];
        $uid = $_POST['uid'];
        
    // Check if the product is already added to cart for the user
        $result = mysqli_query($con, "SELECT * FROM tbl_cart WHERE product_name = '$name' AND uid = '$uid'");
        $count = mysqli_num_rows($result);

        if($count > 0) {
        $sql="UPDATE tbl_cart SET qty = qty + 1 WHERE product_name = '$name'";
        $result = mysqli_query($con,$sql);

        $sql="UPDATE tbl_products SET product_qty = product_qty - 1 WHERE product_name = '$name'";
        $result = mysqli_query($con,$sql);

        $var = 'Item Added!';
        $message = 'Please check your cart!';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';
       
        }else{
        $sql="INSERT INTO `tbl_cart`(`product_name`,`product_price`,`product_description`,`uid`) VALUES ('$name','$cost','$desc','$uid')";

        $result = mysqli_query($con,$sql);

        $var = 'Item Added!';
        $message = 'Please check your cart!';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';
        }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven</title>
    <link rel="icon" type="image/jpg" href="loqo.jpg">

    <script src="sweetalert.min.js"></script>
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href='https://iconscout.com/' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">


</head>
<body>
   
<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class='bx bx-menu'></label>


    <a href="#" class="logo">BookHaven</a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#products">products</a>
        <a href="#review">review</a>
        <a href="#contacts">contacts</a>
<?php

    require_once('functions/connection.php'); 
    require_once('functions/session.php'); 
    if ($logged==true) {
        
        echo '<a href="logout.php">Logout</a>';
    }
?>
    </nav>

    <div class="icons">
        <?php


    if ($logged==false) {
        
    }
    else{
?>
        <a href="favorites.php" class='bx bxs-book-heart'></a>
        <a href="addtocart.php" class='bx bxs-cart'></a>
<?php
        };

            if ($logged==true) {
        
        echo '<a href="location.php" class="bx bxs-edit-location" ></i></a>';
    }
?>
        <a href="login.php" class='bx bxs-user-circle' ></i></a>

    </div>

</header>

<section class="home" id="home">

    <div class="content">
        <h3>books and stationaries</h3>
        <span>essentials</span>
        <p>affordable items</p>
        <a href="#products" class="btn">shop now</a>
    </div>

</section>

<section class="about" id="about">

    <h1 class="heading"> <span> about </span> us </h1>

    <div class="row">

        <div class="video-container">
            <video src="bookvid.mp4" loop autoplay muted></video>
        </div>

        <div class="content">
            <h3>Welcome to BookHaven - Your Literary and Creative Oasis</h3>
            <p>At BookHaven, we celebrate the fusion of literature and creativity, bringing you a haven where the written word meets artistic expression. 
                Our online bookstore and stationery corner cater to the diverse interests of bookworms and creative souls alike, offering a curated selection of books and stationery.</p>
            <p>Book Haven is not just a place to find your next favorite book; it's a haven where the pages of literature and the blank canvases of creativity come together. 
                Immerse yourself in a symphony of stories and artistry as you explore our carefully curated collection of books.</p>
                <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<section class="icons-container">

    <div class="icons">
        <a href="#" class='bx bx-package'></a>
        <div class="info">
            <h3>free delivery</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <a href="#" class='bx bx-money-withdraw'></a>
        <div class="info">
            <h3>10 days returns</h3>
            <span>moneyback guarantee</span>
        </div>
    </div>

    <div class="icons">
        <a href="#" class='bx bxs-shopping-bags'></a>
        <div class="info">
            <h3>offer & gifts</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <a href="#" class='bx bx-credit-card'></a>
        <div class="info">
            <h3>secure payment</h3>
            <span>protected by paypal</span>
        </div>
    </div>

</section>

<section class="products" id="products">

    <h1 class="heading"> Latest <span>Books</span></h1>

    <div class="box-container">
        <?php
        $sql = "SELECT * FROM tbl_products WHERE flag = 0";
        $products = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($products)) {
            $src = $row['img_path'];
            $filename = $row['img_path'];
            $size = getimagesize($filename);
        ?>
            <div class="box">
                <div class="image">
                    <?php
                    if ($size && ($size['mime'] == "image/jpeg" || $size['mime'] == "image/png" || $size['mime'] == "image/jfif")) {
                        echo "<img src='$src' alt=''>";
                    } else {
                        echo "<img src='dm.jpg' alt='NOT FOUND'>";
                    }
                    ?>
                    <form method="POST" action="#">
                        <div class="icons">
                    <?php
                        if ($logged==true) {
                            echo "<button  style='color:#000;' name='addFavs' style='background-color:transparent;'><i class='bx bxs-book-heart'></i></button>";
                        }else{
                            echo "<a href='login.php' style='color:#000;'><button style='background-color:transparent;'><i class='bx bx-book-heart'></i></button></a>";
                        }
                    ?>     
                            <input type="hidden" name="p_name" value="<?php echo $row['product_name']; ?>">
                            <input type="hidden" name="p_price" value="<?php echo $row['product_price']; ?>">
                            <input type="hidden" name="p_desc" value="<?php echo $row['product_description']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['img_path']; ?>">
                            <input type="hidden" name="uid" value="<?php if ($logged == true) { echo $_SESSION['uid']; } ?>">
                    <?php
                        if ($logged==true) {
                            echo "<button style='color:#000;' name='addCart' style='background-color:transparent;'><i class='bx bxs-cart-download'></i></button>";
                        }
                    ?>
                            <a href="#" class='bx bx-share'></a>
                        </div>
                    </form>
                    <div class="content">
                        <h3><?php echo $row['product_name']; ?></h3><br>
                        <h4>Quantity: <?php echo $row['product_qty']; ?></h4><br>
                        <h4><?php echo $row['product_description']; ?></h4>
                        <div class="price"><?php echo $row['product_price']; ?></div>
                    </div>
                </div>
            </div>
        <?php }; ?>
    </div>
    <div class="pagination">
        <button class="prev">Previous</button>
        <button class="next">Next</button>
    </div>
</section>


<section class="products" id="products">

    <h1 class="heading"> Stationary <span>Items</span></h1>

    <div class="box-container">

        <?php
        $sql = "SELECT * FROM tbl_products WHERE flag = 1";
        $products = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($products)) {
            $src = $row['img_path'];
            $filename = $row['img_path'];
            $size = getimagesize($filename);
        ?>
            <div class="box">
                <div class="image">
                    <?php
                    if ($size && ($size['mime'] == "image/jpeg" || $size['mime'] == "image/png" || $size['mime'] == "image/jfif")) {
                        echo "<img src='$src' alt=''>";
                    } else {
                        echo "<img src='dm.jpg' alt='NOT FOUND'>";
                    }
                    ?>
                    <form method="POST" action="#">
                        <div class="icons">
                    <?php
                        if ($logged==true) {
                            echo "<button  style='color:#000;' name='addFavs' style='background-color:transparent;'><i class='bx bxs-book-heart'></i></button>";
                        }else{
                            echo "<a href='login.php' style='color:#000;'><button style='background-color:transparent;'><i class='bx bx-book-heart'></i></button></a>";
                        }
                    ?>     
                            <input type="hidden" name="p_name" value="<?php echo $row['product_name']; ?>">
                            <input type="hidden" name="p_price" value="<?php echo $row['product_price']; ?>">
                            <input type="hidden" name="p_desc" value="<?php echo $row['product_description']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['img_path']; ?>">
                            <input type="hidden" name="uid" value="<?php if ($logged == true) { echo $_SESSION['uid']; } ?>">
                    <?php
                        if ($logged==true) {
                            echo "<button style='color:#000;' name='addStation' style='background-color:transparent;'><i class='bx bxs-cart-download'></i></button>";
                        }
                    ?>
                            <a href="#" class='bx bx-share'></a>
                        </div>
                    </form>
                    <div class="content">
                        <h3><?php echo $row['product_name']; ?></h3><br>
                        <h4>Quantity: <?php echo $row['product_qty']; ?></h4><br>
                        <h4><?php echo $row['product_description']; ?></h4>
                        <div class="price"><?php echo $row['product_price']; ?></div>
                    </div>
                </div>
            </div>
        <?php }; ?>

    </div>

    <div class="pagination">
        <button class="prev">Previous</button>
        <button class="next">Next</button>
    </div>
</section>

<!--content reviews starts-->
<section class="review" id="review">

    <h1 class="heading"> customers <span>review</span></h1>
    <div class="box-container">
<?php

  $sql = "SELECT * FROM tbl_feedback WHERE flag = 1";
  $products = mysqli_query($con,$sql);

  while ($row = mysqli_fetch_array($products)){

  ?>
        <div class="box">
            <div class="stars">
                <i class='bx bx-star'></i>
                <i class='bx bx-star'></i>
                <i class='bx bx-star'></i>
                <i class='bx bx-star'></i>
                <i class='bx bx-star'></i>
            </div>
            <p><?php echo $row['feedback']; ?></p>
            <div class="user">
                <img src="photo.png" alt="">
                <div class="user-info">
                    <h3><?php echo $row['fullname']; ?></h3>
                    <span>Customer Review</span>
                </div>
            </div>
            <span class="fas fa-quote-right"></span>
        </div>
<?php }; ?>
    </div>

</section>

<!--content reviews ends-->
<?php

if(isset($_POST['send_feedback']))
{
    $fullName = $_POST['fullname'];
    $userEmail = $_POST['email'];
    $contactNum = $_POST['contact'];
    $feedBack = $_POST['inquiry'];

    $conn = new mysqli('localhost','root','','bookhaven');
    if($conn->connect_error){
        die('Connection Failed: '.$conn->connect_error);
    }else{

        $stmt = $conn->prepare("insert into tbl_feedback(fullname,email,contactnum,feedback) values(?,?,?,?)");

        $stmt->bind_param("ssss",$fullName,$userEmail,$contactNum,$feedBack);
        $stmt->execute();
        
        $var = 'Feedback/Inquiry Sent!';
        $message = 'Please wait within 24 hours and we will respond to your message :)';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';

        $stmt-> close();
        $conn->close();
    }
}

?>
<!--contact section starts-->
<section class="contact" id="contact">

    <h1 class="heading"> <span> contact </span> us </h1>

    <div class="row">
        <form action="index.php" method="POST">
            <input type="text" placeholder="Name" name="fullname" class="box" required>
            <input type="email" placeholder="Email" name="email" class="box" required>
            <input type="number" placeholder="Number" name="contact" class="box" required>
            <textarea class="box" name="inquiry" placeholder="Feedback" id="" cols="30" rows="10" required></textarea>
            <input type="submit" name="send_feedback" class="btn">
        </form>

        <div class="image">
            <img src="img.jpg" alt="">
        </div>
    </div>
</section>
<!--contact section ends-->

<!--footer section starts-->
<section class="footer">

<div class="box-container">

    <div class="box">
        <h3>quick links</h3>
        <a href="#">Home</a> 
        <a href="#">About</a> 
        <a href="#">Products</a> 
        <a href="#">Review</a> 
        <a href="#">Contacts</a> 

    </div>
    <div class="box">
        <h3>extra links</h3>
        <a href="#">my account</a> 
        <a href="#">my order</a> 
        <a href="#">my favorite</a> 
    
    </div>
    <div class="box">
        <h3>Locations</h3>
        <a href="#">Manila</a> 
        <a href="#">Zamboanga</a> 
        <a href="#">Davao</a> 
        <a href="#">Cebu</a> 
        <a href="#">Ah Jantungku</a> 

    </div>
    <div class="box">
        <h3>contact info</h3>
        <a href="#">+764-424-3232</a> 
        <a href="#">bookhaven@gmail.com</a> 
        <a href="#">San Jose, Zamboanga City- 7000</a> 
        <img src="payment.png" alt="">

    </div>
</div>

<div class="credit"> Created by <span> BookHaven </span> | All Rights Reserved 2024 </div>

</section>
<!--footer section ends-->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const productsContainers = document.querySelectorAll(".products");

        productsContainers.forEach(function (productsContainer) {
            const products = productsContainer.querySelectorAll(".box");
            const productsPerPage = 2;
            const totalPages = Math.ceil(products.length / productsPerPage);
            let currentPage = 1;

            // Function to show products based on the current page
            function showPage(page) {
                const startIndex = (page - 1) * productsPerPage;
                const endIndex = startIndex + productsPerPage;
                products.forEach((product, index) => {
                    if (index >= startIndex && index < endIndex) {
                        product.style.display = "block";
                        product.style.opacity = "1"; // Adjust opacity for fade-in effect
                    } else {
                        product.style.display = "none";
                        product.style.opacity = "0"; // Adjust opacity for fade-out effect
                    }
                });
            }

            // Show the initial page
            showPage(currentPage);

            // Event listener for previous button
            const prevButton = productsContainer.querySelector(".prev");
            prevButton.addEventListener("click", function () {
                currentPage = currentPage > 1 ? currentPage - 1 : 1;
                showPage(currentPage);
            });

            // Event listener for next button
            const nextButton = productsContainer.querySelector(".next");
            nextButton.addEventListener("click", function () {
                currentPage = currentPage < totalPages ? currentPage + 1 : totalPages;
                showPage(currentPage);
            });
        });
    });
</script>

</body>
</html>