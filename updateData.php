<?php 
include('functions/connection.php'); 

if (isset($_POST['updateData'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $payment_method = $_POST['payment_method'];
    $fullname = $_POST['fullname']; // If you also want to update fullname

    $query = "UPDATE tbl_orders 
              SET status = '$status', payment_method = '$payment_method', fullname = '$fullname' 
              WHERE randomizedID = '$id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "<script>
        alert('Data Successfully updated!'); 
        window.location.href='dashboard.php';
        </script>";
    } else {
        echo "ERROR!";
    }
}
?>
