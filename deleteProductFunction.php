<?php

include('functions/connection.php');

    $id = $_GET['id'];
    $query = "DELETE FROM tbl_products WHERE id=$id";

    $query_run = mysqli_query($con,$query);

    if($query_run)
    {
        echo "<script>
        alert('Product has been removed from Database!');
        window.location.href='dashboard.php';
        </script>";
    }
    else
    {
        echo "ERROR!";
    }

?>