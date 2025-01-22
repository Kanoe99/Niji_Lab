<?php

use db\Product;
use db\Group;

require './db/Database.php';
require './db/Product.php';
require './db/Group.php';

$products = (new Product)->getAllProducts();
$groups = (new Group)->getAllGroups();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($products as $product) {
        echo "{$product['name']}<br/>";
    }
    echo "<br/>";
    foreach ($groups as $group) {
        echo "{$group['name']}<br/>";
    }
    ?>
</body>

</html>