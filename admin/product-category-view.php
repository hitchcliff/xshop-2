<?php
include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');


$product_categories = [];

if (!isset($_SESSION['admin'])) {

    $redirectUrl = ADMIN_URL . "login.php";

    header("Location: $redirectUrl");

    $sql = "SELECT * FROM product_categories ORDER BY id DESC";
    $query = $pdo->query($sql);

    if ($query->rowCount() > 0) {
        $product_categories = $query->fetchAll(PDO::FETCH_ASSOC);
    }
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
                                        <?php foreach ($product_categories as $category): ?>
                                            <tr>
                                                <td>
                                                    <?= $category['id'] ?>
                                                </td>
                                                <td>
                                                    <?= $category['name'] ?>
                                                </td>
                                                <td><img src="<?= get_thumb($category['image']) ?>"
                                                        alt="<?= $category['name'] ?>" width="50"></td>
                                                <td class="pt_10 pb_10">
                                                    <a href="" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="" class="btn btn-danger"
                                                        onClick="return confirm('Are you sure?');"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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