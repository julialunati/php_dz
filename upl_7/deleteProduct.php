<?php
include_once('connection.php');

// удаление товара
$id = (int)$_GET['id'];
//удаление картинки товара из папки
$queryProduct = mysqli_query($link, "SELECT * FROM geekbrains.products WHERE id = $id");
$product = mysqli_fetch_assoc($queryProduct);
unlink($product['path']);
//удаление товара из БД
mysqli_query($link, "DELETE FROM geekbrains.products WHERE id=$id");
mysqli_close($link);
header("Location: admin.php");
