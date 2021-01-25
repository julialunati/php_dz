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
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="catalog.html">Catalog</a></li>
                <li><a href="#">Main</a></li>
            </ul>
        </div>
    </div>
    <h1 class="name"><i>Jewellery  from <q><?= $title ?></q></i></h1>
    <div class="body">

        <?php
        $pics = scandir("foto/");
        foreach ($pics as $pic) {
            if ($pic != "." && $pic != ".DS_Store" && $pic != "..") {
                echo '<a href="foto/' . $pic . '" target="blank">';
                echo '<img src="foto/' . $pic . '" height="300"></a>';
            }
        }
        ?>

        <form enctype="multipart/form-data" method="post">
            <input type="file" name="file">
            <input type="submit" value="Send">
        </form>

        <?php
        if (isset($_FILES['file'])) {
            $check = can_upload($_FILES['file']);
            if ($check === true) {
                make_upload($_FILES['file']);
                echo "<b>File uploaded successfully!</b>";
            } else {
                echo "<b> Something went wrong!</b>";
            }
        }
        ?>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava</div>
</body>

</html>