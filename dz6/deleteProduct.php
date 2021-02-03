<?php
include_once('connection.php');

// удаление товара

$productId = (int)$_GET['id'];

mysqli_query($link, "DELETE FROM geekbrains.products WHERE id=$productId");
mysqli_close($link);
header("Location: admin.php");
