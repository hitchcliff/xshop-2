<?php

include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');

if (!isset($_SESSION['admin'])) {

    $redirectUrl = ADMIN_URL . "login.php";

    header("Location: $redirectUrl");
}


if (isset($_POST['form_create_product'])) {
    try {
        $category_name = $_POST['name'];

        if ($_FILES['photo']['size'] <= 0) {
            throw new Exception("Category image is required");
        }

        if (!$category_name) {
            throw new Exception("Category name is required");
        }

        // if upload photo
        $imgs = upload_images($_FILES, ['width' => 350, 'height' => 400]);

        if (count($imgs) > 0) {
            $imgs = json_encode($imgs);

            $sqlForUploadingPhoto = "INSERT INTO product_categories (name, photo) VALUES ('$category_name', '$imgs')";
            $resultForUploadingPhoto = $pdo->query($sqlForUploadingPhoto);

            if ($resultForUploadingPhoto->rowCount() > 0) {
                $success_message = "Upload photo successfully";
                $_SESSION['success_message'] = $success_message;
            } else {
                throw new Exception("Photo upload error");
            }

        }

    } catch (\Throwable $th) {
        $error_message = $th->getMessage();
        $_SESSION['error_message'] = $error_message;
    }
}


?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Product</h1>

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
                                        <label for="photo" class="form-label">Featured Photo: *</label>
                                        <input type="file" class="mt_10" name="photo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">Product Name *</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug" class="form-label">Slug *</label>
                                        <input type="text" class="form-control" name="slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description *</label>
                                        <textarea name="description" class="form-control h_100" cols="30"
                                            rows="10"></textarea>
                                    </div>

                                    <div class="d-flex flex-wrap row-2-form">
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" class="form-control" name="price" id="price">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="sale_price" class="form-label">Sale Price</label>
                                                <input type="text" class="form-control" name="sale_price"
                                                    id="sale_price">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input type="text" class="form-control" name="quantity" id="quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input type="text" class="form-control" name="quantity">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary" name="form_create_product">Create
                                            Product</button>
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

<?php include("./components/footer.php"); ?>