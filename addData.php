<?php
        include 'functions/connection.php';
      
        $name = $_POST['p_name'];
        $cost = $_POST['p_price'];
        $desc = $_POST['p_desc'];
        $uid = $_POST['uid'];


        $sql="INSERT INTO `tbl_cart`(`product_name`,`product_price`,`product_description`,`uid`) VALUES ('$name','$cost','$desc','$uid')";

        $result = mysqli_query($con,$sql);

        echo "<script>

        </script>";

?>