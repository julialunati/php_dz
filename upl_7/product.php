<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

if(isset($_POST['add'])){

    $quantity = (int)$_POST['quantity'];
    $id = (int)$_GET['id'];
    $_SESSION['cart'][$id]=$quantity;
    header("Location: cart.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style/style.css" type="text/css">
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="header">
                <img src="style/logo.png" height="40">
                <ul class="menu">
                    <li><a href="index.php">Main</a></li>
                </ul>
            </div>
        </div>
        <h1 class="name">Detailed info about the product</h1>
        <div class="body">

            <?php

            // отрисовка товара

            $productId = (int)$_GET['id'];

            mysqli_query($link, "UPDATE geekbrains.products SET view = view+1");
            $queryProduct = mysqli_query($link, "SELECT * FROM geekbrains.products WHERE id = $productId");

            $productData = mysqli_fetch_assoc($queryProduct);
            echo '<img src="' . $productData["path"] . '" height="600">';
            echo '<div> Name: ' . $productData["name"] . '</div>';
            echo '<div> Price: ' . $productData["price"] . '€ </div>';
            echo '<div> Views: ' . $productData["view"] . '</div>';
            mysqli_close($link);
            ?>

            <form enctype="multipart/form-data" method="post" action="">
                <span>Choose quantity:</span>

                <input type="number" name="quantity" value="">
                <input type="submit" name="add" value="Add to cart">
            </form>

        </div>
    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>