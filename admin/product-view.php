<?php
include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');



if (!isset($_SESSION['admin'])) {

    $redirectUrl = ADMIN_URL . "login.php";

    header("Location: $redirectUrl");

}
?>


<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Products</h1>
            <div>
                <a href="<?= ADMIN_URL ?>product-create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sale Price</th>
                                            <th>Short Description</th>
                                            <th>Description</th>
                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Capacity</th>
                                            <th>Weight</th>
                                            <th>Pocket</th>
                                            <th>Water Resistant</th>
                                            <th>Warranty</th>
                                            <th>Total Sales</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $products = [];

                                        $sql = "SELECT * FROM products ORDER BY id DESC";
                                        $query = $pdo->query($sql);

                                        if ($query->rowCount() > 0) {
                                            $products = $query->fetchAll(PDO::FETCH_ASSOC);
                                        }

                                        for ($i = 0; $i < count($products); $i++) {
                                            $product_id = $products[$i]['id'];
                                            $product_name = $products[$i]['name'];
                                            $product_slug = $products[$i]['slug'];
                                            $product_quantity = $products[$i]['quantity'];
                                            $product_price = $products[$i]['regular_price'];
                                            $product_sale_price = $products[$i]['sale_price'];
                                            $product_short_description = $products[$i]['short_description'];
                                            $product_description = $products[$i]['description'];
                                            $product_sku = $products[$i]['sku'];
                                            $product_size = $products[$i]['size'];
                                            $product_color = $products[$i]['color'];
                                            $product_capacity = $products[$i]['capacity'];
                                            $product_weight = $products[$i]['weight'];
                                            $product_pocket = $products[$i]['pocket'];
                                            $product_water_resistant = $products[$i]['water_resistant'];
                                            $product_warranty = $products[$i]['warranty'];
                                            $product_total_sales = $products[$i]['total_sale'];
                                            $product_img = get_thumb($products[$i]['featured_photo']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $i + 1 ?>
                                                </td>
                                                <td>
                                                    <?= $product_name ?>
                                                </td>
                                                <td><?= $product_slug ?></td>
                                                <td>
                                                    <?= $product_quantity ?>
                                                </td>
                                                <td>
                                                    <?= $product_price ?>
                                                </td>
                                                <td>
                                                    <?= $product_sale_price ?>
                                                </td>
                                                <td>
                                                    <?= $product_short_description ?>
                                                </td>
                                                <td>
                                                    <?= $product_description ?>
                                                </td>
                                                <td>
                                                    <?= $product_sku ?>
                                                </td>
                                                <td>
                                                    <?= $product_size ?>
                                                </td>
                                                <td>
                                                    <?= $product_color ?>
                                                </td>
                                                <td>
                                                    <?= $product_capacity ?>
                                                </td>
                                                <td>
                                                    <?= $product_weight ?>
                                                </td>
                                                <td>
                                                    <?= $product_pocket ?>
                                                </td>
                                                <td>
                                                    <?= $product_water_resistant ?>
                                                </td>
                                                <td>
                                                    <?= $product_warranty ?>
                                                </td>
                                                <td>
                                                    <?= $product_total_sales ?>
                                                </td>
                                                <td><img src="<?= $product_img ?>" alt="<?= $product_name ?>" width="100">
                                                </td>
                                                <td class="pt_9 pb_10">
                                                    <a class="btn btn-primary"
                                                        href="<?= ADMIN_URL ?>product-category-edit.php?id=<?= $product_id ?>"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="<?= ADMIN_URL ?>product-category-delete.php?id=<?= $product_id ?>"
                                                        class="btn btn-danger" onClick="return confirm('Are you sure?');"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include("./components/footer.php"); ?>