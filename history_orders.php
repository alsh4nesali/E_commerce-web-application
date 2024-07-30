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
<title>Add to Cart Page</title>
<link rel="stylesheet" href="addtocart.css">

  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 18px;
    }

    .container .btn:hover{
        background-color: #000;
        color: #fff;
    }

    .container .table .btn:hover{
        background-color: #000;
        color: #fff;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: 2px solid #ddd; /* Border for the entire table */
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd; /* Border for rows */
    }
    th {
      background-color: #f2f2f2; /* Background color for header row */
    }


  </style>

</head>
<body>
<h1 class="container" style="font-size: 25px;">History of Orders</h1>
<div class="container" >


<table class="table">
    <thead>
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Quantity</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $uid = $_SESSION['uid'];

        // Modified query to combine data with the same randomizedID and include line breaks in product names and quantities
        $query = "
            SELECT 
                randomizedID, 
                GROUP_CONCAT(product_name SEPARATOR '<br>') AS product_names, 
                GROUP_CONCAT(productQty SEPARATOR '<br>') AS quantities, 
                SUM(productQty) AS total_quantity, 
                GROUP_CONCAT(DISTINCT status SEPARATOR ', ') AS status
            FROM 
                tbl_orders 
            WHERE 
                uid = $uid AND status != 'ORDER PLACED'
            GROUP BY 
                randomizedID
            ORDER BY id DESC
        ";

        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['product_names'] . "</td>";
            echo "<td>" . $row['quantities'] . "</td>";
            echo "<td>" . $row['total_quantity'] . "</td>";

            $statuses = explode(', ', $row['status']);
            $statusOutput = "";

            foreach ($statuses as $status) {
                if ($status == 'RECEIVED') {
                    $statusOutput .= "<span style='color:green; font-weight:bold;'>" . $status . "</span>, ";
                } elseif ($status == 'DELIVERED') {
                    $statusOutput .= "<a href='order_received.php?id=" . $row['randomizedID'] . "'><button style='text-align:left; color:green; background-color:#fff; font-weight:bold;'>ORDER RECEIVED</button></a>, ";
                } elseif ($status == 'PENDING') {
                    $statusOutput .= "<a href='order_cancel.php?id=" . $row['randomizedID'] . "'><button style='text-align:left; color:red; background-color:#fff; font-weight:bold;'>CANCEL ORDER</button></a>, ";
                } else {
                    $statusOutput .= $status . ", ";
                }
            }

            echo "<td>" . rtrim($statusOutput, ', ') . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>




</div>
            <div class="container">
                <button class="btn btn-warning" style="font-size: 20px;">Favorites</button>
                <a href="addtocart.php"><button class="btn btn-warning" style="font-size: 20px;">Cart</button></a>
                <a href="index.php"><button class="btn btn-warning" style="font-size: 20px;">Back</button></a>

            </div>
            
</body>
</html>
