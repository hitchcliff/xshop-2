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

if (isset($_POST['form_upload_product_gallery'])) {
    try {
        // Handle photo upload logic here
        $photo = $_FILES['photo'];

        if ($photo['size'] <= 0) {
            throw new Exception("Upload atleast 1 image");
        }

    } catch (\Throwable $th) {
        $error_message = $th->getMessage();
        $_SESSION['error_message'] = $error_message;
        header("Location: $url");
        exit;
    }

}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Photo Gallery</h1>
            <span class="material-symbols-outlined">image</span>
            <span class="ml-2 d-inline-block">ID:
                <?= $_REQUEST['id'] ?? '' ?>
            </span>

            <a href="<?= ADMIN_URL ?>product-view.php" class="ml-auto btn btn-primary">
                Show all Products
            </a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col">

                                <span class="font-italic text-warning">Note: Old images uploaded will be
                                    <b>replaced</b></span>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="photo" class="form-label">Photos: *</label>
                                        <input type="file" class="mt_10" name="photo" id="photo">
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary"
                                            name="form_upload_product_gallery">
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