<?php
include 'database.php';
include 'tree.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task - 2</title>
</head>
<body>
<?php
$database = new database();
$categories = $database->getCategoriesWithNoOfItem();

$tree = new tree();
echo $tree->build($categories, 0);
?>
</body>
</html>