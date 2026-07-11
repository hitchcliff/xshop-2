<?php

include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');
include('./components/is_admin.php');

// product
$id = $_REQUEST['id'];

$sql = "SELECT * FROM products WHERE id='{$id}'";
$query = $pdo->query($sql);

$url = ADMIN_URL . "product-view.php";

if ($query->rowCount() <= 0) {
    header("Location: $url");
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Photo Gallery</h1>
            <span class="ml-2 d-inline-block">ID: <?= $_REQUEST['id'] ?? '' ?></span>
            <span class="material-symbols-outlined">settings</span>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="photo" class="form-label">Photos: *</label>
                                        <input type="file" class="mt_10" name="photo" id="photo">
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary" name="form_create_product">
                                            Upload
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>