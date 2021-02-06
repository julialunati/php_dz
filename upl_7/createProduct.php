<?php

include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//проверка наличия метода POST и задаем путь для картинки 
if (isset($_POST['send'])) {
    $path = 'foto/' . $_FILES['file']['name'];
    copy($_FILES['file']['tmp_name'], $path);
    //обработка имени и цены товара 
    $name = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['name'])));
    $price = (float)$_POST['price'];
    //запрос на добавления товара 
    $queryAddProduct = "INSERT INTO geekbrains.products VALUES (null, '$path', '$name', $price, 0)";
    mysqli_query($link, $queryAddProduct);
    // переход на стр. админа 
    header("Location: admin.php");
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
        <h1 class="name"><i>Add a new product</q></i></h1><br>
        <br>
        <div class="content">
           
            <form enctype="multipart/form-data" method="post" action="">
                <input class="inputFile" type="file" name="file">
                <span>Product name: </span>
                <input type="text" name="name" value="">
                <span>Product price: </span>
                <input type="float" name="price" value="">
                <input type="submit" name="send" value="Send">
            </form>

        </div>
    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>