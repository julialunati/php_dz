<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//получаем джанные о продукте 
$id = (int)$_GET['id'];
$queryProduct = mysqli_query($link, "SELECT * FROM geekbrains.products WHERE id = $id");
$product = mysqli_fetch_assoc($queryProduct);
// $newPath = $product['path']; 

// редактирование продукта 

if (isset($_POST['update'])) {

    $price = (float)$_POST['price'];
    $name = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['name'])));
    $newPath = false;

    //проверяем появилась ли новая картинка 

    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        $newPath = 'foto/' . $_FILES['file']['name'];
        copy($_FILES['file']['tmp_name'], $newPath);
    }

    $queryUpdateProduct = "UPDATE geekbrains.products SET `name`='$name', `price`=$price";
    //при появлении новой картинки добавляем ее путь в запрос 
    if ($newPath) {
        $queryUpdateProduct .= ", `path`='$newPath'";
    }

    $queryUpdateProduct .= " WHERE id = $id";
    mysqli_query($link, $queryUpdateProduct);
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
        <h1 class="name"><i>Edit a product</q></i></h1><br>

        <div class="content">
    
                <form enctype="multipart/form-data" method="post" action="">
                    <img src="<?= $product['path'] ?>" width="200">
                    <div><span>Product image</span>
                    <input class="inputFile" type="file" name="file"></div>
                    <input hidden type="text" name="id" value="<?= $product['id'] ?>">
                    <span>Product name </span>
                    <input type="text" name="name" value="<?= $product['name'] ?>">
                    <span>Product price </span>
                    <input type="float" name="price" value="<?= $product['price'] ?>">
                    <input type="submit" name="update" value="Update">
                </form>

        </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>