<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';

class ProductException extends Exception{}

try {
  // для подключения темплейтов
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  $twig->addGlobal('session', $_SESSION);

  $result = mysqli_query($link, "SELECT id, `path`, `name`, price, view  FROM products ORDER BY view ASC");
  $products = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
  }
  
  // exception for products
  if(empty($products)){
    throw new ProductException('Database is empty!');
  }

  $template = $twig->load('init.twig');
  $template->display([
    'title' => 'Time to Shine',
    'currentYear' => 2021,
    'products' => $products,
  ]);
  
} catch (ProductException $e) {
  echo 'ERROR: ' . $e->getMessage();
} catch (Exception $e) {  
  echo 'ERROR: ' . $e->getMessage();
} 