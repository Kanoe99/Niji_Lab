<?php
require "./db/connect.php";
use db\Database;

//do class for fetching so queries would be smaller

$db = new Database();
$results = $db->query("SELECT * from `groups` where id = :id", ["id" => 1])->find();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= $results['name'] ?>
</body>

</html>