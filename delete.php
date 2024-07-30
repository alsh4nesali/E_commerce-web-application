<?php

    include('functions/connection.php'); 

    $id = $_GET['id'];

    $query = "DELETE FROM tbl_cart WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        echo "<script>
        alert('Product removed from cart!');
        window.location.href='addtocart.php';
        </script>";
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }

?>