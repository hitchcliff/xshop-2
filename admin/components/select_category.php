<select name="category_id" id="category_id">
    <?php
    $categories = [];

    $sql = "SELECT * FROM product_categories ORDER BY id DESC";
    $query = $pdo->query($sql);

    if ($query->rowCount() > 0) {
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    for ($i = 0; $i < count($categories); $i++) {
        $category_id = $categories[$i]['id'];
        $category_name = $categories[$i]['name'];
        ?>
        <option value="<?= $category_id ?>">
            <?= $category_name ?>
        </option>
        <?php
    }

    ?>

</select>