<?php
require_once('functions/connection.php');
require_once('functions/session.php');

if ($logged == false) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Order</title>
    <link rel="stylesheet" href="order.css">
    <script src="sweetalert.min.js"></script>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 150px;
            text-align: right;
            margin-right: 10px;
        }
        select, input {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="order-container">
        <header>
            <h1>Placed Order</h1>
        </header>
        <main>
            <form method="POST" action="#">
                <section class="order-summary">
                    <h2>Order Summary</h2>
                    <ul>
                        <?php
                        $uid = $_SESSION['uid'];
                        $sql = "SELECT * FROM tbl_cart WHERE uid = $uid AND flag = '0'";
                        $products = mysqli_query($con, $sql);
                        $total = 0;

                        while ($row = mysqli_fetch_array($products)) {
                            $item_total = $row['product_price'] * $row['qty'];
                            $total += $item_total;
                            ?>
                            <li>
                                <span class="product-name"><?php echo $row['product_name']; ?></span>
                                <span class="product-price">P<?php echo $item_total; ?></span>
                                <span class="product-quantity">Quantity: <?php echo $row['qty'] ?></span>
                            </li>
                        <?php }; ?>
                        <input type="hidden" value="<?php echo $_SESSION['uid']; ?>" name="uid">
                        <input type="hidden" name="total" value="<?php echo $total + 100; ?>">
                    </ul>

                        <input id="shipping-fee" type="hidden" readonly value="100" />

                    <p>Shipping Fee: PHP <?php echo 100; ?></p>
                    <p>Total Price: PHP <?php echo $total + 100; ?></p>
                </section>

                <?php
                $user = $_SESSION['username'];
                $result = mysqli_query($con, "SELECT * FROM user WHERE username = '$user'");
                $test = mysqli_fetch_array($result);

                $id = $test['id'];
                $fname = $test['f_name'];
                $lname = $test['l_name'];
                $addr = $test['address'];
                $contact = $test['user_contact'];
                ?>

                <section class="delivery-info">
                    <h2>Delivery Information</h2>
                    <p>Shipping Address: <?php echo $addr; ?></p>
                    <p>Contact Number: <?php echo $contact; ?></p>
                    <p>Estimated Delivery Date: <?php echo date("m/d/y", strtotime("+1 week")); ?></p>
                </section>
                <section class="payment-info">
                    <h2>Payment Information</h2>
                    <div class="form-group">
                        <label for="payment-method">Mode of Payment</label>
                        <select id="payment-method" name="payment-method">
                            <option>COD</option>
                            <option>Paypal</option>
                        </select>
                    </div>
                    <button class="place-order-button" type="submit" name="placeOrder">Place Order</button>
            </form>
        </main>
    </div>
</div>

<?php
if (isset($_POST['placeOrder'])) {
    $uid = $_SESSION['uid'];
    $payment_method = $_POST['payment-method'];
    $shipping_fee = 100;
    $total = $_POST['total'];

    // Function to generate a unique randomizedID
    function generateRandomizedID($con) {
        do {
            // Generate a new randomizedID
            $randomizedID = floor(100 + rand() * 900);
            // Check if the generated randomizedID already exists
            $check_query = "SELECT COUNT(*) as count FROM tbl_orders WHERE randomizedID = $randomizedID";
            $check_result = mysqli_query($con, $check_query);
            $row = mysqli_fetch_assoc($check_result);
            $count = $row['count'];
        } while ($count > 0); // Keep generating new randomizedID until it's unique
        return $randomizedID;
    }

    // Generate a unique randomizedID
    $randomizedID = generateRandomizedID($con);

    // Prepare the SQL query
    $sql = "INSERT INTO tbl_orders (product_name, fullname, product_price, productQty, uid, address, payment_method, fee, randomizedID)
        SELECT 
            tbl_cart.product_name, 
            CONCAT(user.f_name, ' ', user.l_name), 
            tbl_cart.product_price * tbl_cart.qty, 
            tbl_cart.qty, 
            tbl_cart.uid, 
            user.address, 
            '$payment_method', 
            $shipping_fee, 
            $randomizedID
        FROM tbl_cart
        JOIN user ON tbl_cart.uid = user.id
        WHERE tbl_cart.uid = $uid AND tbl_cart.flag = '0'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    if ($result) {
        $today = date("m/d/y");

        $query = "UPDATE tbl_orders SET status = 'ORDER PLACED', todayDate = '$today' WHERE uid = $uid AND status NOT IN ('PENDING', 'CANCELED', 'ON TRANSIT', 'DELIVERED', 'OUT FOR DELIVERY', 'RECEIVED')";


        $query_run = mysqli_query($con, $query);

        $sql = "DELETE FROM tbl_cart WHERE uid = $uid";
        $sql_run = mysqli_query($con, $sql);

        $var = 'Order has been placed!';
        $message = 'Please wait within 24 hours for us to prepare your order :)';

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
        echo "Error: " . mysqli_error($con);
    }
}
?>

</body>
</html>
