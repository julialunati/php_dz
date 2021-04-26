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

  $sql = "UPDATE geekbrains.products SET view = view+1 WHERE id = $productId";
  $dbh->query($sql);
  $sql = "SELECT * FROM geekbrains.products WHERE id = $productId";
  $sth = $dbh->query($sql);
  $product = $sth->fetchObject();

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
