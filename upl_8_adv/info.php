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
                    <li><a href="#">Cart</a></li>
                    <li><a href="login.php">Sign in</a></li>
                    <li><a href="index.php">Main</a></li>
                </ul>
            </div>
        </div>
        <h2 class="name"><i>THANK YOU FOR YOUR ORDER</i></h2>

        <div> In 2-3 days you will recieve your order. </div>
        <div> <a href="index.php">Go to main page</a> </div>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>