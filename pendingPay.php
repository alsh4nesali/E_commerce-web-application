<?php 

$id = $_GET['id'];

include('functions/connection.php');

// Prepare the query
$query = "UPDATE tbl_orders SET status = 'PENDING' WHERE randomizedID = ?";

$stmt = mysqli_prepare($con, $query);

// Bind the parameter
mysqli_stmt_bind_param($stmt, 's', $id);

// Execute the statement
$query_run = mysqli_stmt_execute($stmt);

if($query_run) {
    $var = 'Order Accepted!';
    $message = 'Please check the Order List :)';

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
    echo '<script type="text/javascript">';
    echo "setTimeout(function () { 
        Swal.fire({
            title: '$var',
            text: '$message',
            icon: 'success'
        }).then(function() {
            window.location.href = 'dashboard.php';
        });
    }, 1000);";
    echo '</script>';
} else {
    echo mysqli_stmt_error($stmt);
}

// Close the statement
mysqli_stmt_close($stmt);

?>
