<?php

require './db/Database.php';
require './db/Group.php';
require './db/Product.php';

use db\Group;
use db\Product;

$groups = (new Group)->getAllGroups();
$products = (new Product)->getAllProducts();

function hierarchy($groups, $parentId = 0): array
{
    $tree = [];
    foreach ($groups as $group) {
        $children = [];
        if ($group['id_parent'] == $parentId) {

            $children = hierarchy($groups, $group['id']);
            if ($children) {
                $group['children'] = $children;
            }

            $tree[] = $group;
        }
    }
    return $tree;
}

function showMenu($sorted)
{
    echo "<ul>";

    foreach ($sorted as $item) {
        echo "<li><a href='#' onclick=\"console.log('test');\">" . $item['name'];
        if (array_key_exists('children', $item)) {
            showMenu($item['children']);
        }
        echo "</a></li>";
    }

    echo "</ul>";
}

// $flatArray = [1, 3, 4, 5, 6, 7, 8];
$flatArray = [3, 5, 6];

function makeList($flatArray, $products)
{
    $data = [];
    foreach ($products as $product) {
        if (in_array($product['id_group'], $flatArray)) {
            $data[] = $product;
        }
    }
    return $data;
}

function displayList($dataList)
{
    echo "<ul style='display: flex; flex-direction: column;'>";
    foreach ($dataList as $item) {
        echo "<li>{$item['name']}</li>";
    }
    echo "</ul>";
}

$menu = hierarchy($groups);
$dataList = makeList($flatArray, $products);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div style="display: flex; gap: 50px;">
        <div>
            <?php

            showMenu($menu);

            ?>
        </div>
        <div style="border: 5px solid black; padding: 20px 30px">
            <?
            displayList($dataList);
            ?>
        </div>
    </div>


</body>

</html>