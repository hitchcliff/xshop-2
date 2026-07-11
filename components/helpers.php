<?php

function get_product_category($pdo, $category_id)
{

    $sql = "SELECT * FROM product_categories WHERE id='$category_id'";
    $query = $pdo->query($sql);

    if ($query->rowCount() > 0) {
        $category = $query->fetch(PDO::FETCH_ASSOC);
        return $category['name'];
    }

    return "Unknown Category";

}