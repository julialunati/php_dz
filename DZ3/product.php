<?php
session_start();
require 'db.php';
// для подключения twig
require 'vendor/autoload.php';

class ProductIdException extends Exception{}

try {
  // для подключения темплейтов
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $productId = (int)$_GET['id'];

  // если не передался id
  if(!$productId){
    throw new ProductIdException('The product id is not identified!');
  }
  
  mysqli_query($link, "UPDATE geekbrains.products SET view = view+1 WHERE id = $productId");
  $result = mysqli_query($link, "SELECT * FROM geekbrains.products WHERE id = $productId");
  $product = mysqli_fetch_assoc($result);

  $template = $twig->load('product.twig');
  $template->display([
    'title' => 'Time to Shine',
    'currentYear' => 2021,
    'product' => $product,
  ]);

} catch (ProductIdException $e) {  
  echo 'ERROR: ' . $e->getMessage();
} catch (Exception $e) {  
  echo 'ERROR: ' . $e->getMessage();
}
