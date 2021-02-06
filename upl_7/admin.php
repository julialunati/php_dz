<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//при нажатии на кнопку производим log out админа и перенаправляем на главную старницу 
if(isset($_POST['logout'])){
    unset($_SESSION['login']);
    header("Location: index.php");
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
        <h1 class="name">Admin</h1><br>

        <!-- приветствуем админа вошедего по логину -->
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

        <div>
            <a href="createProduct.php"> Create a new product </a>
        </div>
        <div class="content">

            <?php

            // отрисовка товаров 

            $queryAll = mysqli_query($link, "SELECT * FROM products ORDER BY id ASC");

            while ($dataProducts = mysqli_fetch_assoc($queryAll)) {
                echo '<div class="product"><img src="' . $dataProducts["path"] . '" height="200">';
                echo '<span>Product internal number: ' . $dataProducts["id"] . '</span>';
                echo '<span><a href="editProduct.php?id=' . $dataProducts["id"] . '">Edit</a></span>';
                echo '<span><a href="deleteProduct.php?id=' . $dataProducts["id"] . '">Delete</a></span></div>';
            }
            mysqli_close($link);
            ?>

        </div>
    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>