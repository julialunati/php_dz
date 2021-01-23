<?php
$title = "Time To Shine";
$greeting = "<h1>Greetings! We're glad to see you on our website.</h1>";
$currentYear = 2021;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style/style.css" type="text/css">
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="foto/logo.png" height="40">
            <ul class="menu">
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="catalog.html">Catalog</a></li>
                <li><a href="#">Main</a></li>
            </ul>
        </div>
    </div>
    <h1 class="name"><i>Jewellery  from <q><?= $title ?></q></i></h1>
    <div class="body">
        <p><?= $greeting ?><br>
            Choose what is more suitable for you in our spring-summer collection <?= $currentYear ?></p>
        <!-- <img src="foto/bril.GIF" height="500"> -->

        <?php

        //price table
        $arr = [
            'bracelets' => [
                'bracelets prices' => [20, 40, 60],
                'bracelets materials' => ['silver', 'plastic'],
            ],
            'rings' => [
                'rings prices' => [12, 34, 20],
                'rings materials' => ['silver', 'gold'],
            ],
            'necklace' => [
                'necklace prices' => [120, 240, 290],
                'necklace materials' => ['silver', 'gold'],
            ],
        ];

        echo "All information about our products: ";
        foreach ($arr as $keys => $key) {
            echo "<h1><ul>$keys</ul></h1>";
            foreach ($key as $value => $values) {
                echo "<li>$value</li>";
                foreach ($values as $detail) {
                    echo "<p>$detail</p>";
                }
            }
        }

        ?>

    </div>
    <div class="footer">All rights reserved <?php echo date('Y') ?>&copy; Yuliya Molakava</div>
</body>

</html>