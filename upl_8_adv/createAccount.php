<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;
session_start();

//проверка наличия метода POST и задаем путь для картинки 
if (isset($_POST['create'])) {
    //обработка logina 
    $login = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['login']))); 
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'user';
    //запрос на добавления пользователя 
    $queryAddUser = "INSERT INTO geekbrains.user VALUES (null, '$login', '$hash', '$role')";
    mysqli_query($link, $queryAddUser);
    // переход на стр. админа 
    header("Location: login.php");
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
                    <!-- <li><a href="cart.php">Cart</a></li> -->
                    <!-- <li><a href="admin.php">Admin</a></li> -->
                    <li><a href="index.php">Main</a></li>
                </ul>
            </div>
        </div>

        <h2 class="name"><i>Create account</q></i></h2>

        <div class="content">

            <form enctype="multipart/form-data" method="post" action="">
                <span>login</span>
                <input type="text" name="login" value="">
                <span>password</span>
                <input type="text" name="password" value="">
                <input type="submit" name="create" value="CREATE">
            </form>

        </div>
        <br>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>