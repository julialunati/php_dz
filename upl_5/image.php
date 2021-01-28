<?php
include_once('functions.php');
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
    <div class="container">
        <div class="header">
            <img src="style/logo.png" height="40">
            <ul class="menu">
                <li><a href="index.php">Main</a></li>
            </ul>
        </div>
    </div>
    <h1 class="name">View image</h1>
    <div class="body">

        <?php

        // отрисовка картинки
        $imgId = $_GET['id'];
        $link3 = mysqli_connect('localhost:3306', 'root', 'newpass', 'geekbrains');
        mysqli_query($link3, "INSERT INTO foto (id, views) VALUES ($imgId, 1) ON DUPLICATE KEY UPDATE views = views+1");
        $req = mysqli_query($link3, "SELECT * FROM geekbrains.foto WHERE id = $imgId");
        
        $pic = [];

        while ($row = mysqli_fetch_assoc($req))
            $pic[] = $row;
        echo '<img src="' . $pic[0]["foto_path"] . '" height="600">';
        echo '<div>Views: ' .$pic[0]["views"] . '</div>'

        ?>


    </div>

    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava</div>
</body>

</html>