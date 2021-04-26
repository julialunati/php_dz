<?php

// connect to mysql
try {
    $dbh = new PDO('mysql:dbname=geekbrains;host=localhost:3306', 'root', 'newpass');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // если ошибка в соединении
    
} catch (PDOException $e) {
    echo '<img src="foto/db.png">';
    echo 'ERROR: ' . $e->getMessage();
}
