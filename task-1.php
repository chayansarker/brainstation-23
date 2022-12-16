<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task - 1</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <th>Category Name</th>
    <th>Total Items</th>
    </thead>
    <tbody>
    <?php

    $database = new database();

    $categories = $database->getOrderedCategoriesWithTotalItem();

    foreach ($categories as $category) {
        ?>
        <tr>
            <td><?php echo $category['name']; ?></td>
            <td><?php echo $category['items_count']; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>