<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

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
                    <li><a href="#">Cart</a></li>
                    <li><a href="login.php">Sign in</a></li>
                    <li><a href="index.php">Main</a></li>
                </ul>
            </div>
        </div>
        <h2 class="name"><i>Cart</q></i></h2>

        <div class="cart">


            <?php


            $arr = $_SESSION['cart'];
            foreach ($arr as $key => $value) {
                // отрисовка товаров добавленных в корзину
                $query = mysqli_query($link, "SELECT * FROM geekbrains.products WHERE id = $key");
                $product = mysqli_fetch_assoc($query);
                echo '<div class="cartProduct"><img src="' . $product["path"] . '" height="200">';
                echo '<div> Name: ' . $product["name"] . '</div>';
                echo '<div> Price: ' . $product["price"] . '€ </div>';
                echo '<div> Quantity: ' . $value . '</div>';
                $total = $value * $product["price"];
                echo '<div> Total price: ' . $total . '€ </div>';
                //делаем кнопку на удаление товара из корзины
                echo '<form enctype="multipart/form-data" method="post" action="">
                        <input type="submit" name="delete" value="Delete from cart">
                    </form></div>';
                $finalTotal =+ $total;    
            }

            // удаление товара из корзины
            if (isset($_POST['delete'])) {
                unset($_SESSION['cart'][$key]);
            }

            echo "<br><div>TOTAL: {$finalTotal}€ </div>";

            ?>



        </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>