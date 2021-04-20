
<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';
// Кол-во элементов для вывода

try{
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  $limit = 4; 
  // Получение записей для нового show more
  $count = intval($_GET['count']);
  $count = (empty($count)) ? 1 : $count;				
  $start = ($count != 1) ? $count * $limit - $limit : 0;
  
  $sql = "SELECT * FROM products LIMIT {$start}, {$limit}";
  $sth = $dbh->query($sql);
  $products = [];
  while ($row = $sth->fetchObject()) {
      $products[] = $row;
  }			

  $template = $twig->load('showmore.twig');
  $template->display([
    'products' => $products,
  ]);

}catch (Exception $e) {  
  echo 'ERROR: ' . $e->getMessage();
}
	
 

