<?php

    require_once('functions/session.php'); 
    if ($logged==false) {
         header("Location:index.php");
    }


if(isset($_GET['updateData'])){
      
    $id = $_GET['id'];
    $status = $_GET['status'];

    $query = "
    UPDATE tbl_orders 
    SET status = '$status' WHERE randomizedID = '$id'";

    $query_run = mysqli_query($con,$query);

    if($query_run)
    {

    }
    else
    {
       echo "ERROR!";
    }

}


if(isset($_POST['insertStationary'])){
      
      $name = $_POST['product'];
      $cost = $_POST['cost'];
      $desc = $_POST['desc'];
      $qty = $_POST['qty'];
      $flag = $_POST['flag'];

       $targetPath = 'img/';
       $target_file = $targetPath . basename( $_FILES['image']['tmp_name'],PATHINFO_EXTENSION);

      if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
            $image = 'img/'. basename( $_FILES['image']['tmp_name'],PATHINFO_EXTENSION);
            $sql="INSERT INTO `tbl_products`(`product_name`,`product_price`,`product_description`,`product_qty`,`img_path`,`flag`) VALUES ('$name','$cost','$desc','$qty','$image','$flag')";

        $result = mysqli_query($con,$sql);
        $var = 'Stationary Product Added!';
        $message = 'Please Refresh the page to check the new products :)';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';

      }else{
         echo "ERROR!";
      }

}


if(isset($_POST['insertProduct'])){
      
      $name = $_POST['product'];
      $cost = $_POST['cost'];
      $qty = $_POST['qty'];
      $desc = $_POST['desc'];

       $targetPath = 'img/';
       $target_file = $targetPath . basename( $_FILES['image']['tmp_name'],PATHINFO_EXTENSION);

      if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
            $image = 'img/'. basename( $_FILES['image']['tmp_name'],PATHINFO_EXTENSION);
            $sql="INSERT INTO `tbl_products`(`product_name`,`product_price`,`product_description`,`product_qty`,`img_path`) VALUES ('$name','$cost','$desc','$qty','$image')";

        $result = mysqli_query($con,$sql);
        $var = 'Product Added!';
        $message = 'Please Refresh the page to check the new products :)';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { swal('$var','$message','success')";
        echo '}, 1000);</script>';

      }else{
         echo "ERROR!";
      }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="dashboard.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
        <div class="sidebar">
            <div class="logo">BookHaven</div>
            <ul class="main">
               <li class="active">
                  <a href="dashboard.php">
                   <i class="fas fa-tachometer-alt"></i>
                   <span>Dashboard</span>
                  </a> 
               </li>
                <li>
                   <a href="#" data-bs-toggle="modal" data-bs-target="#chooseModal">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Products</span>
                   </a> 
                </li>
                <li>
                   <a href="" data-bs-toggle="modal" data-bs-target="#salesModal">
                    <i class="fas fa-chart-simple"></i>
                    <span>Sales</span>
                   </a> 
                </li>
                <li>
                   <a href="#" data-bs-toggle="modal" data-bs-target="#reviewsModal">
                    <i class="fas fa-star"></i>
                    <span>Reviews</span>
                   </a> 
                </li>
                <li>
                   <a href="#" data-bs-toggle="modal" data-bs-target="#ordersModal">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Orders</span>
                   </a> 
                </li>
                <li class="logout">
                   <a href="logout.php">
                       <i class="fas fa-sign-out-alt"></i>
                       <span>Logout</span>
                   </a>
                </li>
           </ul>
        </div>
      <div class="main--content">
         <div class="header--wrapper">
            <div class="header--title">
               <span>Admin</span>
               <h2>Dashboard</h2>
            </div>
            <div class="user--info">
               <div class="search--box">
                  <i class="fa-solid 
                  fa-search"></i>
                  <input type="text" placeholder="Search">
               </div>
               <img src="photo.png" alt="">
            </div>
         </div>
         <div class="card-container">
            <h3 class="main--title"> Today's Data</h3> 
            <div class="card--wrapper">
               <div class="payment--card">
                  <div class="card--header">
                     <div class="amount">
                        <span class="title">
                           Daily Earnings
                        </span>
                        <span class="amount-value">
<?php
                    $sql = "SELECT SUM(product_price) as total FROM tbl_orders ";
                    $res_data = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($res_data)){
                        echo $row['total'];
                    }
?>

                        </span>
                     </div>
                     <i class="fas fa-peso-sign icon"></i>
                  </div>
                  <span class="card-detail"></span>
               </div>
               <div class="payment--card">
                  <div class="card--header">
                     <div class="amount">
                        <span class="title">
                           Products
                        </span>
                        <span class="amount-value">
                     <?php

                         $query = "SELECT id FROM tbl_products ORDER BY id";
                         $run = mysqli_query($con,$query);

                         $row = mysqli_num_rows($run);
                         echo '<h3>'.$row.'</h3>';

                     ?>
                  </span>
                     </div>
                     <i class="fas fa-list icon 
                     dark-blue"></i>
                  </div>
                  <span class="card-detail"></span>
               </div>
               <div class="payment--card">
                  <div class="card--header">
                     <div class="amount">
                        <span class="title">
                           Customer/User
                        </span>
                        <span class="amount-value" style="font-weight: bold;">
                     <?php

                         $query = "SELECT id FROM user ORDER BY id";
                         $run = mysqli_query($con,$query);

                         $row = mysqli_num_rows($run);
                         echo '<h3>'.$row.'</h3>';

                     ?>
                        </span>
                     </div>
                     <i class="fas fa-users icon 
                     dark-red"></i>
                  </div>
                  <span class="card-detail"></span>
               </div>
               <div class="payment--card">
                  <div class="card--header">
                     <div class="amount">
                        <span class="title">
                           Daily Orders
                        </span>
                        <span class="amount-value">
                     <?php

                         $query = "SELECT id FROM tbl_orders ORDER BY id";
                         $run = mysqli_query($con,$query);

                         $row = mysqli_num_rows($run);
                         echo '<h3>'.$row.'</h3>';

                     ?>
                        </span>
                     </div>
                     <i class="fas fa-solid fa-check icon 
                     dark-brown"></i>
                  </div>
                  <span class="card-detail"></span>
               </div>
            </div>
         </div>
         <div class="tabular--wrapper">
            <h3 class="main--title">Records of Purchase</h3>
            <div class="table-container">
<table id="orderTable" style="font-weight: bold;">
    <thead>
        <tr style="color: #000;">
            <th>Date of order</th>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Mode of payment</th>
            <th>Shipping Fee</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Query to get the combined data for rows with the same randomizedID
        $query = "
            SELECT 
                randomizedID, 
                id, 
                GROUP_CONCAT(DISTINCT fullname SEPARATOR ', ') AS fullname, 
                SUM(product_price) AS total_price, 
                GROUP_CONCAT(DISTINCT status SEPARATOR ', ') AS status,
                MAX(todayDate) AS todayDate, 
                MAX(payment_method) AS payment_method, 
                MAX(fee) AS fee 
            FROM 
                tbl_orders 
            GROUP BY 
                randomizedID
            ORDER BY id DESC
        ";

        $result = mysqli_query($con, $query);

        // Initialize variables to hold the total of product prices and shipping fees
        $grand_total_price = 0;
        $grand_total_fee = 0;

        while ($row = mysqli_fetch_array($result)) {
            
            echo "<tr>";

            // Display date of order
            echo '<td>' . htmlspecialchars(date("m/d/y", strtotime($row["todayDate"]))) . '</td>';
            echo '<td style="color:maroon;">' . htmlspecialchars($row["randomizedID"]) . '</td>'; // Display randomizedID
            echo '<td>' . htmlspecialchars($row["fullname"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["payment_method"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["fee"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["total_price"] + $row["fee"]) . '</td>';

            // Accumulate totals
            $grand_total_price += $row["total_price"];
            $grand_total_fee += $row["fee"];

            // Display statuses
            $statuses = explode(', ', $row['status']);
            $allStatusesPlaced = true;
            foreach ($statuses as $status) {
                if ($status !== "ORDER PLACED") {
                    $allStatusesPlaced = false;
                    break;
                }
            }
            if ($allStatusesPlaced) {
                echo '<td style="color:#000; font-weight:bold;">ORDER PLACED</td>';
            } else {
                echo '<td style="color:green; font-weight:bold;">' . htmlspecialchars($row["status"]) . '</td>';
            }

            echo '<td>
                <a class="btn btn-primary" title="Approve" href="pendingPay.php?id=' . htmlspecialchars($row['randomizedID']) . '"><i class="fa fa-check-circle"></i></a> ||';
            echo '
                <a class="btn btn-warning" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal' . htmlspecialchars($row['id']) . '"><i class="fa fa-edit"></i></a>';
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8" style="color: #000;">
                Total: P 
                <?php
                // Display the total sum of product prices and shipping fees
                echo $grand_total_price + $grand_total_fee;
                ?>
            </td>
        </tr>
    </tfoot>
</table>



            </div>            
         </div>
      </div>


      <!-- Modal -->

<?php
include('functions/connection.php'); 

$result = mysqli_query($con, "SELECT * FROM tbl_orders");

while ($row = mysqli_fetch_array($result)) {
?>
   <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <form method="POST" action="updateData.php">
             <div class="row">
               <div class="col">
                 <input type="text" style="font-weight: bold;" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" class="form-control" placeholder="Full name" aria-label="Full name">
               </div>
               <div class="col">
                 <input type="text" class="form-control" name="payment_method" style="font-weight: bold;" value="<?php echo htmlspecialchars($row['payment_method']); ?>" placeholder="Mode of Payment" aria-label="Mode of Payment">
               </div>
             </div>
             <br>
             <div class="row">
               <div class="col">
                 <br>
                 <select class="form-select" aria-label="Default select example" name="status" style="font-weight: bold; color: green;">
                   <option value="<?php echo htmlspecialchars($row['status']); ?>"><?php echo htmlspecialchars($row['status']); ?></option>
                   <option value="ON TRANSIT">ON TRANSIT</option>
                   <option value="DELIVERED">DELIVERED</option>
                   <option value="DELAYED">DELAYED</option>
                   <option value="OUT FOR DELIVERY">OUT FOR DELIVERY</option>
                   <option value="CANCELED">CANCELED</option>
                 </select>
                 <input type="hidden" value="<?php echo $row['randomizedID']; ?>" name="id">
               </div>
             </div>
         </div>
         <div class="modal-footer">
           <button type="submit" name="updateData" class="btn btn-primary">Save changes</button>
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        </form>
       </div>
     </div>
   </div>
<?php
}
?>

 
   <div class="modal fade" id="chooseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Products</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="dashboard.php" method="POST" enctype="multipart/form-data">
         <div class="modal-body text-center">
            <a href="#" class="btn btn-warning fs-4" data-bs-toggle="modal" data-bs-target="#bookModal">Books</a>
            <a href="#" class="btn btn-primary fs-4" data-bs-toggle="modal" data-bs-target="#stationaryModal">Stationary</a>
            <a href="#" class="btn btn-primary fs-4" data-bs-toggle="modal" data-bs-target="#allProductsModal">View All Products</a>
         </div>
         
         </form>
       </div>
     </div>
   </div>


   <div class="modal fade" id="allProductsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">List of All Products</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Product Name</th>
                     <th scope="col">Price</th>
                     <th scope="col">Description</th>
                     <th scope="col">Action</th>
                     <th scope="col">Action</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_products ");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['product_price'] . "</td>";
              echo "<td>" . $row['product_description'] . "</td>";
              echo "<td><button type='button' class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#editProductModal".$row['id']."'>EDIT</button></td>";
              echo "<td><button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteProductModal".$row['id']."'>DELETE</button></td>";
              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>

<?php
//EDIT PRODUCTS Function
            $result = mysqli_query($con,"SELECT * FROM tbl_products ");

            while($row = mysqli_fetch_array($result))
              {
?>
   <div class="modal fade" id="editProductModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product Information</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
<form method="POST" action="editProductFunction.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['product_name']; ?>" name="product_name">
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Product Price</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['product_price']; ?>" name="product_price">
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Product Description</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['product_description']; ?>" name="product_description">
        </div>

            <div class="mb-3">
              <label for="formFile" class="form-label">Product Image</label>
              <input class="form-control" type="file" id="formFile" name="image">
            </div>

         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-danger">Save changes</button>
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
</form>
       </div>
     </div>
   </div>

<?php

}

?>


<?php
//DELETE PRODUCTS Function
            $result = mysqli_query($con,"SELECT * FROM tbl_products ");

            while($row = mysqli_fetch_array($result))
              {
?>
   <div class="modal fade" id="deleteProductModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form method="GET" action="deleteProductFunction.php">
         <div class="modal-body">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <P>Are you sure you want to delete this product?</P>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-danger">YES</button>
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        </form>
       </div>
     </div>
   </div>
<?php

}

?>

   <div class="modal fade" id="ordersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Order List</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

            <button class="btn btn-secondary" data-bs-toggle='modal' data-bs-target='#intransitModal' >IN TRANSIT</button>
            <button class="btn btn-secondary" data-bs-toggle='modal' data-bs-target='#outModal' >OUT FOR DELIVERY</button>
            <button class="btn btn-success" data-bs-toggle='modal' data-bs-target='#deliveredModal'>DELIVERED</button>
            <button class="btn btn-success" data-bs-toggle='modal' data-bs-target='#placedModal'>PLACED ORDERS</button>
            <button class="btn btn-warning" data-bs-toggle='modal' data-bs-target='#delayedModal'>DELAYED</button>
            <button class="btn btn-danger" data-bs-toggle='modal' data-bs-target='#cancelModal'>CANCELED</button><br><br>

               <table class="table">
                 <thead>
                   <tr>
                    <th scope="col">Transaction ID</th>
                     <th scope="col">Fullname</th>
                     <th scope="col">Product</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Address</th>
                   </tr>
                 </thead>
                 <tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM tbl_orders ORDER BY randomizedID");

// Initialize previous randomizedID variable
$prev_randomizedID = null;

while ($row = mysqli_fetch_array($result)) {
    // Check if randomizedID is equal to the previous one
    if ($row['randomizedID'] == $prev_randomizedID) {
        // If randomizedID is the same, continue the current row
        echo "<td></td>"; // Empty cell for randomizedID
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['productQty'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "</tr>"; // Close the row
    } else {
        // If randomizedID is different, start a new row
        echo "<tr>";
        echo "<td><button class='btn btn-primary'  data-bs-toggle='modal' data-bs-target='#idModal" . $row['id'] . "'>" . $row['randomizedID'] . "</button></td>";
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['productQty'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "</tr>"; // Close the row

        // Update the previous randomizedID
        $prev_randomizedID = $row['randomizedID'];
    }
}

echo "</tbody>";
echo "</table>";
?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>


<?php
$resultOrders = mysqli_query($con, "SELECT * FROM tbl_orders");

while ($rowOrders = mysqli_fetch_array($resultOrders)) {
    $randomizedID = mysqli_real_escape_string($con, $rowOrders['randomizedID']);
?>

    <!-- Modal -->
    <div class="modal fade" id="idModal<?php echo $rowOrders['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $rowOrders['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel<?php echo $rowOrders['id']; ?>">Customer Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-5">
                        <h2>Customer Order Information</h2>

                        <?php
                        $resultOrderDetails = mysqli_query($con, "SELECT * FROM tbl_orders WHERE randomizedID = '$randomizedID'");

                        while ($rowOrderDetails = mysqli_fetch_array($resultOrderDetails)) {
                        ?>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col">Fullname: <?php echo htmlspecialchars($rowOrderDetails['fullname']); ?></div>
                                        <div class="col">Address: <?php echo htmlspecialchars($rowOrderDetails['address']); ?></div>
                                        <div class="col">Shipping Fee: 100(-50)</div>
                                        <div class="col">Product Name: <?php echo htmlspecialchars($rowOrderDetails['product_name']); ?></div>
                                        <div class="col">Total payment: <?php echo htmlspecialchars($rowOrderDetails['product_price'] + 50); ?></div>
                                        <div class="col">Product Quantity: <?php echo htmlspecialchars($rowOrderDetails['productQty']); ?></div>
                                        <div class="col" style="color:white; background-color:green;">Status: <?php echo htmlspecialchars($rowOrderDetails['status']); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>


   <div class="modal fade" id="intransitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">IN TRANSIT ORDERS</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Fullname</th>
                     <th scope="col">Product</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Address</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_orders WHERE status = 'ON TRANSIT'");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['productQty'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>

   <div class="modal fade" id="deliveredModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">DELIVERED AND RECEIVED ORDERS</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Fullname</th>
                     <th scope="col">Product</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Address</th>
                     <th scope="col">Status</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_orders WHERE status = 'DELIVERED' OR status = 'RECEIVED' ");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['productQty'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>

   <div class="modal fade" id="outModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">OUT FOR DELIVERY</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Fullname</th>
                     <th scope="col">Product</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Address</th>
                     <th scope="col">Status</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_orders WHERE status = 'OUT FOR DELIVERY'");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['productQty'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>

   <div class="modal fade" id="placedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">PLACED ORDERS</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Fullname</th>
                     <th scope="col">Product</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Address</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_orders WHERE status = 'ORDER PLACED'");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['productQty'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>

   <div class="modal fade" id="delayedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">DELAYED ORDERS</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Fullname</th>
                     <th scope="col">Product</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Address</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_orders WHERE status = 'DELAYED'");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['productQty'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>


   <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">CANCELED ORDERS</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Fullname</th>
                     <th scope="col">Product</th>
                     <th scope="col">Quantity</th>
                     <th scope="col">Address</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_orders WHERE status = 'CANCELED'");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['product_name'] . "</td>";
              echo "<td>" . $row['productQty'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>


   <div class="modal fade" id="stationaryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Add new Stationary</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="dashboard.php" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="flag" value="1">
         <div class="modal-body">
           <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="product">
            </div>

           <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Product Cost</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="cost">
            </div>

           <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Product Quantity</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="qty">
            </div>

            <div class="mb-3">
              <label for="formFile" class="form-label">Product Image</label>
              <input class="form-control" type="file" id="formFile" name="image">
            </div>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Product Description</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
            </div>
         </div>
         
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" name="insertStationary" class="btn btn-primary">Save changes</button>
         </div>
         </form>
       </div>
     </div>
   </div>



   <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Add new Book</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="dashboard.php" method="POST" enctype="multipart/form-data">
         <div class="modal-body">
           <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="product">
            </div>
           <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Product Cost</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="cost">
            </div>
           <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Product Quantity</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="qty">
            </div>
            <div class="mb-3">
              <label for="formFile" class="form-label">Product Image</label>
              <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Product Description</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
            </div>
         </div>
         
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" name="insertProduct" class="btn btn-primary">Save changes</button>
         </div>
         </form>
       </div>
     </div>
   </div>


   <div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Reviews/Feedback</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">Fullname</th>
                     <th scope="col">Email</th>
                     <th scope="col">Contact</th>
                     <th scope="col">Feedback/Review</th>
                     <th scope="col">Action</th>
                     <th scope="col">Action</th>
                   </tr>
                 </thead>
                 <tbody>
            <?php

            $result = mysqli_query($con,"SELECT * FROM tbl_feedback ");

            while($row = mysqli_fetch_array($result))
              {
              echo "<tr>";
              echo "<td>" . $row['fullname'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['contactnum'] . "</td>";
              echo "<td>" . $row['feedback'] . "</td>";
              if($row['flag'] != 1){
              echo "<td><a rel='facebox' href='pinReview.php?id=".$row['id']."'><span class=\"btn btn-warning btn-xs glyphicon glyphicon-eye-open\"><i class='fa fa-map-pin'></i></span></td>";
              }else{
                echo "<td><a rel='facebox' href='unpinReview.php?id=".$row['id']."'><span class=\"btn btn-danger btn-xs glyphicon glyphicon-eye-open\"><i class='fa fa-minus-square'></i></span></td>";
              }
                echo "<td><a rel='facebox' href='deleteReview.php?id=".$row['id']."'><span class=\"btn btn-danger btn-xs glyphicon glyphicon-eye-open\"><i class='fa fa-remove'></i></span></td>";

              };
              echo "</tbody>";
            echo "</table>";

            ?>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>


      <div class="modal fade" id="salesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-l">
       <div class="modal-content ">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Data Visualization</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

            <canvas id="donutChart" width="400" height="400"></canvas>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        
       </div>
     </div>
   </div>
    <script>
    $(document).ready(function() {
        $('#orderTable').DataTable();
    });
    </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to handle passing ID to modal
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-body #modal-id').text('ID: ' + id);
        });
    </script>



        <script>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "bookhaven";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                $result = mysqli_query($conn,"SELECT todayDate, COUNT(*) as count FROM tbl_orders GROUP BY todayDate");
                $data = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = ['label' => $row['todayDate'], 'value' => $row['count']];
                }

                // Format the data as JSON
                $data_json = json_encode($data);
                ?>
            // Get the data from PHP
            var data = <?php echo $data_json; ?>;

            // Create the donut chart
            var ctx = document.getElementById('donutChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.map(item => item.label),
                    datasets: [{
                        data: data.map(item => item.value),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    cutoutPercentage: 30 // Adjust as needed, this will control the size of the hole in the middle of the doughnut chart
                }
            });
        </script>

    </body>
</html>