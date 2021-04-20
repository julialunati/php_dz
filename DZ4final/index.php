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

  // Получение записей для первого вывода
  $sql = "SELECT * FROM products LIMIT 4";
  $sth = $dbh->query($sql);
  $products = [];
  while ($row = $sth->fetchObject()) {
    $products[] = $row;
  }
  
  // Кол-во товаров в БД
  $sql = "SELECT COUNT(id) FROM products";
  $sth = $dbh->query($sql);
  (integer)$total = $sth->fetchColumn();
  $amount = ceil($total/3);

  // exception for products
  if(empty($products)){
    throw new ProductException('Database is empty!');
  }

  $template = $twig->load('init.twig');
  $template->display([
    'title' => 'Time to Shine',
    'currentYear' => 2021,
    'products' => $products,
    'amount' => $amount,
  ]);
  
} catch (ProductException $e) {
  echo 'ERROR: ' . $e->getMessage();
} catch (Exception $e) {  
  echo 'ERROR: ' . $e->getMessage();
} 