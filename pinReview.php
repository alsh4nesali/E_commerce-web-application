<?php 
    
    include('functions/connection.php');
    $id = $_GET['id'];
    $query = "UPDATE tbl_feedback SET flag = '1' WHERE id = '$id'";

    $query_run = mysqli_query($con,$query);

    if($query_run)
    {
        echo "<script>
        alert('Review has been pinned!');
        window.location.href='dashboard.php';
        </script>";
    }
    else
    {
        echo "ERROR!";
    }

 ?>