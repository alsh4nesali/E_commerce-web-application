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

if(isset($_POST['update_data'])){ 
    // Assuming $con is your database connection and $_SESSION['uid'] is set

    $userid = $_SESSION['uid'];

    foreach ($_POST['qty_id'] as $key => $quantity_id) {
        $qty = $_POST['qty_item'][$key];
        $id = $quantity_id;

        // Update only the row corresponding to the current item
        $sql = "UPDATE tbl_cart SET qty = $qty WHERE uid = $userid AND id = $id";
        $query = $con->prepare($sql);

        if($query->execute()) {
            // Do something after each successful update
        } else {
            // Handle the error
            echo "Error updating record: " . $query->error;
        }
    }

    // Redirect after processing all items
    echo "<script>window.location.href='order.php';</script>";
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
.quantity-container {
  display: flex;
  align-items: center;
}

.quantity-container input[type="number"] {
  width: 50px;
  text-align: center;
  border: 1px solid #ccc;
  padding: 5px;
  font-size: 16px;
  margin: 0;
}

.quantity-button {
  width: 30px;
  height: 28px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  user-select: none;
  font-size: 20px;
  margin: 0;
}

.quantity-button.up {
  border-right: none;
}

.quantity-button.down {
  border-left: none;
}

.quantity-button:active {
  background-color: #e0e0e0;
}
</style>
<script>
function incrementValue(e) {
  const input = e.target.closest('.quantity-container').querySelector('input');
  input.value = parseInt(input.value) + 1;
}

function decrementValue(e) {
  const input = e.target.closest('.quantity-container').querySelector('input');
  if (input.value > 1) {
    input.value = parseInt(input.value) - 1;
  }
}
</script>
</head>
<body>
<div class="container">
    <h1>My Shopping Cart</h1>
    <a href="my_orders.php"><button class="btn btn-warning">My orders</button></a>
    <a href="history_orders.php"><button class="btn btn-warning">History of Orders</button></a><br><br>
    <div class="cart">
<?php

$uid = $_SESSION['uid'];

$sql = "SELECT * FROM tbl_cart WHERE uid = $uid AND flag = '0' ORDER BY id DESC";
$products = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($products)){

?>
        <div class="cart-item">
            <div class="product-info">
                <p class="product-name"><?php echo $row['product_name']; ?></p>
                <p class="product-price">P<?php echo $row['product_price'] * $row['qty']; ?></p>
                <div class="quantity">
                    <p>Quantity:</p>
                    <form method="POST" action="addtocart.php">
                    <div class="quantity-container">
                        <div class="quantity-button up" onclick="incrementValue(event)">▲</div>
                        <input type="number" value="<?php echo $row['qty'] ?>" name="qty_item[]" class="quantity-input" required>
                        <div class="quantity-button down" onclick="decrementValue(event)">▼</div>
                    </div>
                    <input type="hidden" name="qty_id[]" value="<?php echo $row['id']; ?>">
                </div>
            </div>
            
            <div class="actions">
                 <?php echo " <a class='btn delete-btn' style='text-decoration:none;' href='delete.php?id=".$row['id']."' >"?><i class="fas fa-trash-alt"></i> Delete</a>
                 <input type="hidden" value="<?php echo $row['product_name'] ?>">
                 <input type="hidden" value="<?php echo $row['product_price'] ?>">
            </div>
        </div>
<?php }; ?>
    </div>
    <div class="checkout-container">
    <button class="btn checkout-btn" type="submit" name="update_data">Checkout</button>
    </form>
        <a href="index.php" class="btn cancel-btn" style='text-decoration:none;'><i class="fas fa-times" ></i> Cancel</a>
    </div>
</div>
</body>
</html>
