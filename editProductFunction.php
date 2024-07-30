<?php 
    
    include('functions/connection.php');

    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];

    $targetPath = 'img/';
    $target_file = $targetPath . basename( $_FILES['image']['tmp_name'],PATHINFO_EXTENSION);

if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
    $image = 'img/'. basename( $_FILES['image']['tmp_name'],PATHINFO_EXTENSION);
    $query = "UPDATE tbl_products 
    SET product_name = '$product_name', product_price = '$product_price', product_description = '$product_description', img_path = '$image'
    WHERE id = '$id'";

    $query_run = mysqli_query($con,$query);

    if($query_run)
    {
        echo "<script>
        alert('Product has been changed!');
        window.location.href='dashboard.php';
        </script>";
    }

}else{
    $query = "UPDATE tbl_products 
    SET product_name = '$product_name', product_price = '$product_price', product_description = '$product_description'
    WHERE id = '$id'";

    $query_run = mysqli_query($con,$query);

    if($query_run)
    {
        echo "<script>
        alert('Product has been changed!');
        window.location.href='dashboard.php';
        </script>";
    }else{
        echo "ERROR";
    }
    }