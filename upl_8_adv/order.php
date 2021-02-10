<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();


if (isset($_POST['submit'])) {

    $orderId = (int)$_GET['id'];
    $firstName = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['first']))); 
    $secondName = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['second']))); 
    $number = (int)$_POST['number'];
    $deliveryAddress = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['address']))); 

    $queryAddOrder = "INSERT INTO geekbrains.order VALUES ($orderId, '$firstName', '$secondName', $number, '$deliveryAddress', 'created')";
    mysqli_query($link, $queryAddOrder);
    mysqli_close($link);
    unset($_SESSION);
     // переход на стр. админа 
     header("Location: info.php");
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
        <h2 class="name"><i>CHECKOUT</i></h2>

        <div class="checkout">

            <form class="checkoutForm" enctype="multipart/form-data" method="post" action="">
                <span>Frst name </span>
                <input type="text" name="first" value="">
                <span>Second name </span>
                <input type="text" name="second" value="">
                <span>Phone number</span>
                <input type="number" name="number" value="">
                <span>Delivery address</span>
                <input type="text" name="address" value=""><br>
                <input type="submit" name="submit" value="SUBMIT">
            </form>

        </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>