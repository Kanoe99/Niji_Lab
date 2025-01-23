<?php

require './db/Database.php';
require './db/Group.php';
require './db/Product.php';

use db\Group;

$groups = (new Group)->getAllGroups();

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

function show($sorted)
{
    echo "<pre>";
    var_dump($sorted);
    echo "</pre>";
}

show(hierarchy($groups));

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

    foreach ($groups as $group): ?>
        <ul>
            <li>
                <?= $group['name']; ?>
            </li>
        </ul>
    <?php endforeach; ?>


</body>

</html>