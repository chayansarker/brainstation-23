<?php
include 'const.php';
class database
{
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        }catch (Exception $exception){
            echo 'connection failed:' . $exception->getMessage();
        }
    }

    public function getOrderedCategoriesWithTotalItem(){
        $data = [];

        $query = 'SELECT 
    c.`name` `name`,
    (SELECT 
            COUNT(*)
        FROM
            `Item` i
                INNER JOIN
            `Item_category_relations` icr ON i.`Number` = icr.`ItemNumber`
        WHERE
            c.`Id` = icr.`categoryId`) AS `items_count`
FROM
    `category` c
WHERE c.Disabled = 0
ORDER BY `items_count` DESC';

        $result = $this->conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getCategoriesWithNoOfItem(){
        $data = [];

        $query = 'SELECT 
    c.`Id` cat_id,
    c.`name` cat_name,
    IFNULL(cr.ParentcategoryId, 0) as parentcat_id,
    (SELECT 
            COUNT(*)
        FROM
            `Item` i
                INNER JOIN
            `Item_category_relations` icr ON i.`Number` = icr.`ItemNumber`
        WHERE
            c.`Id` = icr.`categoryId`) AS `items_count`
FROM
    `category` c
        LEFT JOIN
    catetory_relations cr ON cr.categoryId = c.Id
WHERE
    c.Disabled = 0';

        $result = $this->conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $data['category'][$row['cat_id']] = $row;
            $data['parent'][$row['parentcat_id']][] = $row['cat_id'];
        }

        return $data;
    }
}