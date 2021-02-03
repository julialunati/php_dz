<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
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
                    <li><a href="#">Main</a></li>
                </ul>
            </div>
        </div>
        <h1 class="name"><i>Jewellery  from <q><?= $title ?></q></i></h1><br>
        <h2 class="name"><i>Catalog</q></i></h2>

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