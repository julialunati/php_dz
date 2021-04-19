<?php
session_start();
require 'db.php';

if (isset($_POST['id']) && $_POST['id'] && isset($_POST['quantity']) && $_POST['quantity']) {

    $quantity = (int)$_POST['quantity'];
    $id = (int)$_POST['id'];
    $_SESSION['cart'][$id] = $quantity;
    // если товар удачно добавлен в сессию 
    echo json_encode(array('success' => 1));
} else {
    // если что-то пошло не так
    echo json_encode(array('success' => 0));
}

