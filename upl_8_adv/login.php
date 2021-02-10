<?php
include_once('connection.php');
$title = "Time To Shine";
$currentYear = 2021;


if (isset($_POST['enter'])) {
    //получаем данные от пользовталя
    $login = mysqli_real_escape_string($link, htmlspecialchars(strip_tags($_POST['login']))); 
    $password = $_POST['password'];
    //получаем от БД данные
    $queryUser = mysqli_query($link, "SELECT * FROM geekbrains.user WHERE `login` = '$login'");
    $userData = mysqli_fetch_assoc($queryUser);
    //получаем хэш пароля
    $hash = $userData['password'];
    //делаем сверку паролей 
    if (password_verify($password, $hash)) {
        
        session_start();
        //login в БД является уникальным значением 
        $_SESSION['login'] = $userData['login'];
        $_SESSION['role'] = $userData['role'];
        if($_SESSION['role'] == 'admin'){
            header("Location: admin.php");
        }else{
            header("Location: index.php");
        }
    }
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

        <h2 class="name"><i>SIGN IN</q></i></h2>

        <div class="content">

            <form enctype="multipart/form-data" method="post" action="">
                <span>login</span>
                <input type="text" name="login" value="">
                <span>password</span>
                <input type="text" name="password" value="">
                <input type="submit" name="enter" value="SIGN IN">
            </form>

        </div>
        <br>
        <div>OR</div>
        <h2 class="name"><a href="createAccount.php">Create account</a></i></h2>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava⠀</div>
</body>

</html>