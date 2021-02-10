<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//внесение заказа (только товаров на данном этапе) в БД 

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
        <h2 class="name"><i>List of all orders in database</q></i></h2>

        <div class="cart">

            <?php

            $queryOrder = mysqli_query($link, "SELECT * FROM geekbrains.order");
            while ($order = mysqli_fetch_assoc($queryOrder)) {
                echo '<div class="cartProduct"><div>' . $order["order_id"] . '</div>';
                echo '<div> First name: ' . $order["first_name"] . '</div>';
                echo '<div> Second name: ' . $order["second_name"] . ' </div>';
                echo '<div> Phone number: ' . $order["phone_number"] . '</div>';
                echo '<div> Delivery address: ' . $order["address"] . '</div>';
                echo '<div> Order status: ' . $order["status"] . '</div>';
                //делаем кнопку на удаление товара из корзины
                echo '<div><a href="editOrder.php?id=' . $order["order_id"] . '">Edit the order</a>
                        </div></div>';
            };

            ?>

        </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>