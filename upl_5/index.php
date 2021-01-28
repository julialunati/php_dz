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
                <!-- <li><a href="contacts.html">Contacts</a></li> -->
                <li><a href="image.php">View image</a></li>
                <!-- <li><a href="#">Main</a></li> -->
            </ul>
        </div>
    </div>
    <h1 class="name"><i>Jewellery  from <q><?= $title ?></q></i></h1>
    <div class="body">

        <?php

        // загрузка картинки в галерею 

        if (isset($_FILES['file'])) {
            $check = can_upload($_FILES['file']);
            if ($check === true) {
                make_upload($_FILES['file']);
                echo '<div class="zatemnenie">File uploaded successfully!</div>';
            } else {
                echo '<div class="zatemnenie">Something went wrong!</div>';
            }
        }

        // отрисовка галереи картинок 

        $result = mysqli_query($link, "SELECT * FROM foto WHERE id > 0 ORDER BY views DESC");
        $pics = [];

        while ($row = mysqli_fetch_assoc($result))
            $pics[] = $row;
        for ($i = 0; $i < count($pics); $i++) {
            echo '<a href="' . $pics[$i]["foto_path"] . '" target="blank">';
            echo '<img src="' . $pics[$i]["foto_path"] . '" height="300"></a>';
        }
        mysqli_close($link);

        ?>

        <form enctype="multipart/form-data" method="post">
            <input type="file" name="file">
            <input type="submit" value="Send">
        </form>

     
    </div>

    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava</div>
</body>

</html>