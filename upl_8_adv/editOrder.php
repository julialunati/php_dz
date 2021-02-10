<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//получаем инфо о заказе 
$orderId = (int)$_GET['id'];
$queryOrder = mysqli_query($link, "SELECT * FROM geekbrains.order WHERE order_id = $orderId");
$order = mysqli_fetch_assoc($queryOrder);

// редактирование заказа 

if (isset($_POST['update'])) {

    $phoneNumber = (int)$_POST['phone_number'];
    $address = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['address'])));
    $status = $_POST['status'];

    $queryUpdateOrder = "UPDATE geekbrains.order SET `phone_number`=$phoneNumber, `address`='$address', `status`='$status' WHERE order_id = $orderId";
    mysqli_query($link, $queryUpdateOrder);

    header("Location: orderList.php");
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
                    <li><a href="#">Basket</a></li>
                    <li><a href="admin.php">Admin</a></li>
                    <li><a href="index.php">Main</a></li>
                </ul>
            </div>
        </div>
        <h1 class="name"><i>Edit the order №<?= $id ?></q></i></h1><br>

        <div class="content">

            <form enctype="multipart/form-data" method="post" action="">
                <input hidden type="text" name="id" value="<?= $order['id'] ?>">
                <div>First name <?= $order['first_name'] ?> </div>
                <div>Second name <?= $order['second_name'] ?> </div>
                <!-- Following information can be added by administrator in case of error -->
                <div><span>Phone number</span>
                    <input type="number" name="phone_number" value="<?= $order['phone_number'] ?>">
                </div>
                <div><span>Address</span>
                    <input type="text" name="address" value="<?= $order['address'] ?>">
                </div>
                <p>Choose order status
                    <select size="1" name="status">
                        <option selected value="created">created</option>
                        <option value="delivered">delivered</option>
                        <option value="cancelled">cancelled</option>
                    </select>
                </p>
                <input type="submit" name="update" value="Update">
            </form>

        </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>