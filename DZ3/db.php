<?php

class LinkException extends Exception{}

// connect to mysql
try {
    $link = mysqli_connect('localhost:3306', 'root', 'newpass', 'geekbrains');
    // если ошибка в соединении
    if (!$link) {
        throw new LinkException('Cannot connect to specfied database!');
    }
} catch (LinkException $e) {
    echo '<img src="foto/db.png">';
    echo 'ERROR: ' . $e->getMessage();
}
