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
            <h1>Product Category</h1>
            <div>
                <a href="<?= ADMIN_URL ?>product-category-create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Category
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
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $product_categories = [];

                                        $sql = "SELECT * FROM product_categories ORDER BY id DESC";
                                        $query = $pdo->query($sql);

                                        if ($query->rowCount() > 0) {
                                            $product_categories = $query->fetchAll(PDO::FETCH_ASSOC);
                                        }

                                        for ($i = 0; $i < count($product_categories); $i++) {
                                            $product_id = $product_categories[$i]['id'];
                                            $product_name = $product_categories[$i]['name'];
                                            $product_img = get_thumb($product_categories[$i]['photo']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $i + 1 ?>
                                                </td>
                                                <td>
                                                    <?= $product_name ?>
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