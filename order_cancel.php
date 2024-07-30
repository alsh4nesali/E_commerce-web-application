<?php

include('functions/connection.php');
include('functions/session.php');

    	$uid = $_SESSION['uid'];
    	$id = $_GET['id'];
        // Update only the row corresponding to the current item
        $sql = "UPDATE tbl_orders SET status = 'CANCELED' WHERE randomizedID = $id AND uid = $uid";
        $query = $con->prepare($sql);

        if($query->execute()) {

        $var = 'Order has been Cancelled!';
        $message = 'Send us a Feedback :)';

        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script type="text/javascript">';
        echo "setTimeout(function () { 
            Swal.fire({
                title: '$var',
                text: '$message',
                icon: 'success'
            }).then(function() {
                window.location.href = 'index.php';
            });
        }, 1000);";
        echo '</script>';

        } else {
            // Handle the error
            echo "Error updating record: " . $query->error;
        }
    
    



?>