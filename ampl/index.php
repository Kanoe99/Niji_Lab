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
        // Use JavaScript to handle the click event
        echo "<li><a href='#' onclick='handleGroupClick(" . $item['id'] . ")'>" . $item['name'];
        if (array_key_exists('children', $item)) {
            showMenu($item['children']);
        }
        echo "</a></li>";
    }
    echo "</ul>";
}

$menu = hierarchy($groups);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    function handleGroupClick(groupId) {
        event.preventDefault();
        console.log("Selected Group ID:", groupId);
        fetchProducts(groupId);
    }

    function fetchProducts(groupId) {
        fetch(`get_products.php?group_id=${groupId}`)
            .then(response => response.json())
            .then(data => {
                displayProducts(data);
            })
            .catch(error => console.error("Error fetching products:", error));
    }

    function displayProducts(products) {
        const productList = document.getElementById("product-list");
        productList.innerHTML = ""; // Clear the current list

        products.forEach(product => {
            const li = document.createElement("li");
            li.textContent = product.name;
            productList.appendChild(li);
        });
    }
    </script>
</head>
<body>
    <div style="display: flex; gap: 50px;">
        <div>
            <?php showMenu($menu); ?>
        </div>
        <div style="border: 5px solid black; padding: 20px 30px">
            <div id="product-list">
                <?php
                // Display initial product list (if any)
                $dataList = makeList($flatArray ?? [], $products);
                displayList($dataList);
                ?>
            </div>
        </div>
    </div>
</body>
</html>