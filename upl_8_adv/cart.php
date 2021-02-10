<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//внесение заказа (только товаров на данном этапе) в БД 

if (isset($_POST['submit'])) {
    //находим номер последнего заказа
    $queryOrderId = mysqli_query($link, "SELECT MAX(`order_id`) FROM geekbrains.order_item");
    $arrOrderId = mysqli_fetch_row($queryOrderId);
    $lastOrderId = (int)$arrOrderId[0];
    // номер текущего заказа
    $currentOrderId = $lastOrderId + 1;

    $arr = $_SESSION['cart'];
    foreach ($arr as $key => $value) {
        // получение добавленных товаров в корзину
        $query = mysqli_query($link, "SELECT * FROM geekbrains.products WHERE id = $key");

        $orderedProduct = mysqli_fetch_assoc($query);
        $productId = $orderedProduct["id"];
        $price = $orderedProduct["price"];
        $quantity = $value;
        $total =  $price * $quantity;

        //запрос на добавления заказа 
        $queryAddOrder = "INSERT INTO geekbrains.order_item VALUES ($currentOrderId, $productId, $price, $quantity, $total)";
        mysqli_query($link, $queryAddOrder);
    }
    //удаляем данные из корзины так как они уже есть в БД
    unset($_SESSION['cart']);
    // переход на стр. заполнения данных клиента 
    header("Location: order.php?id=$currentOrderId");
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
                        <input type="submit" name="delete" value="DELETE">
                    </form></div>';
                $finalTotal += $total;

            }

            // удаление товара из корзины
            if (isset($_POST['delete'])) {
                unset($_SESSION['cart'][$key]);
            }

            if ($_SESSION['cart']) {
                echo "<br><div>TOTAL: {$finalTotal}€ </div>";
                echo '<form enctype="multipart/form-data" method="post" action="">
                      <input type="submit" name="submit" value="CHECKOUT"></form>';
            } else {
                echo "<br><div>YOUR CART IS EMPTY</div>";
                echo '<a href="index.php">Go to shopping</a>';
            }

            ?>



        </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>