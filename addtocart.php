<?php
include('./includes/dbconn.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Add_To_cart'])) {
        $name = $_POST['Item_name'];
        $productDetail = mysqli_query($mysqli, "SELECT * FROM products where name='$name'");
        $product = mysqli_fetch_array($productDetail);
        if ($product['stock'] < $_POST['Mod_Quantity']) {
            echo '<script>alert("Insufficient stock");
        window.location.href="index.php";</script>';
        } else 
        if (isset($_SESSION['cart'])) {
            $myitems = array_column($_SESSION['cart'], 'Item_name');
            if (in_array($_POST['Item_name'], $myitems)) {
                echo "<script>alert('Product already added');
                window.location.href='./mycart.php';</script>";
            } else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array('Item_name' => $_POST['Item_name'], 'price' => $_POST['price'], 'Quantity' => 1);

                // DB Insert Code
                echo "<script> alert('Product added to the cart');
      window.location.href='./mycart.php';
      </script>";
            }
        } else {
            $_SESSION['cart'][0] = array('Item_name' => $_POST['Item_name'], 'price' => $_POST['price'], 'Quantity' => 1);
            echo "<script>
    alert('Product added to the cart');
    window.location.href='./index.php';
    </script>";
        }
    }

    //for remove button
    if (isset($_POST['Remove_Item'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_name'] == $_POST['Item_name']) {
                unset($_SESSION['cart'][$key]);               //removes home
                $_SESSION['cart'] = array_values($_SESSION['cart']);   //rearrange array after removing any item
                echo "<script>
      alert('Product Removed from the cart');
      window.location.href='./mycart.php';
      </script>";
            }
        }
    }
    //to modify quantity
    if (isset($_POST['Mod_Quantity'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_name'] == $_POST['Item_name']) {
                $_SESSION['cart'][$key]['Quantity'] = $_POST['Mod_Quantity'];
                echo "<script>window.location.href='./mycart.php';</script>";
            }
        }
    }
}
