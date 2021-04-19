<?php
session_start();
require 'db.php';
// для подключения twig
require 'vendor/autoload.php';

try {
    // для подключения темплейтов
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    //получаем товары текущей сессии 
    $arr = $_SESSION['cart'];
    // переменные для дальнейшей работы с темплейтом 
    $products = [];
    $finalTotal;
    // получаем данные для $products и  $finalTotal
    foreach ($arr as $key => $value) {
      //  $link = mysqli_connect('localhost:3306', 'root', 'newpass', 'geekbrains');
        $result = mysqli_query($link, "SELECT * FROM geekbrains.products WHERE id = $key");
        while ($row = mysqli_fetch_assoc($result)) {
            $quantity = 'quantity';
            $row[$quantity] = $value;
            $total = 'total';
            $totalPrice = $value * $row["price"];
            $finalTotal += $totalPrice;
            $row[$total] = $totalPrice;
            $products[] =  $row;
        }
    }
    // удаление товара из корзины
    if (isset($_POST['delete'])) {
        unset($_SESSION['cart'][$key]);
    }
    // работа с темплейтами 
    $template = $twig->load('cart.twig');
    $template->display([
        'title' => 'Time to Shine',
        'currentYear' => 2021,
        'products' => $products,
        'finalTotal' => $finalTotal,
    ]);

    // эксепшены
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}
