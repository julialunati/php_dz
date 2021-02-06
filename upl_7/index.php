<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//при нажатии на кнопку производим log out пользвоателя 
if(isset($_POST['logout'])){
    unset($_SESSION['login']);
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
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="login.php">Sign In</a></li>
                    <li><a href="#">Main</a></li>
                </ul>

            </div>
        </div>
        <h1 class="name"><i>Jewellery  from <q><?= $title ?></q></i></h1><br>
        <h2 class="name"><i>Catalog</q></i></h2><br>

        <!-- приветствуем пользователя вошедего по логину  -->
        <div> 
            <?php 
            if($_SESSION['login']){
                echo "<h3> Hello, {$_SESSION['login']} </h3>";
                //создаем кнопку для log out 
                echo '<form enctype="multipart/form-data" method="post" action="">
                      <input type="submit" name="logout" value="log out">
                      </form>';
            }
            ?>
        </div>

        <div class="content">
            <?php

            // отрисовка галереи картинок 

            $queryAllProducts = mysqli_query($link, "SELECT * FROM products ORDER BY view ASC");

            while ($dataProducts = mysqli_fetch_assoc($queryAllProducts)) {
                echo '<div class="product"><a href="product.php?id=' . $dataProducts["id"] . '">';
                echo '<img src="' . $dataProducts["path"] . '" height="300"></a>';
                echo '<span> Price: ' . $dataProducts["price"] . '</span></div>';
            }
            mysqli_close($link);

            ?>

        </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>