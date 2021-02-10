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
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <style>
      #productAdded {
        width: 300px;
        height: 25px;
        background-color: #9CEE90;
        text-align: center;
        padding: 15px;
        border: 1px solid black;
        border-radius: 10px;
        color: black;
        display: none;
        position: absolute;
        top: 100px;
        right: 10px;
        margin: auto; 
      }
    </style>
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
            <div id="productAdded"></div>
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

            <form id="addProduct" method="post">
                <input hidden type="text" name="id" value="<?= $productId ?>">
                <span>Choose quantity:</span>
                <input type="number" name="quantity" value="" min="1" max="5">
                <input type="submit" name="add" value="Add to cart">
            </form>


        </div>
    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#addProduct').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'addProduct.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        // если товар удачно добавлена на бэкенде
                        if (jsonData.success == "1") {
                            document.getElementById('productAdded').innerHTML = 'Product added to your shopping cart!';
                            document.getElementById('productAdded').style.display = "block";
                            //надпись пропадет чере 3 секунды 
                            $('#productAdded').delay(3000).fadeOut();
                        } else {
                            alert('Oops! Something went wrong. Please try again in a moment.');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>