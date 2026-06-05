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
        $product_name = $_POST['name'];
        $product_slug = $_POST['slug'];

        if ($_FILES['photo']['size'] <= 0) {
            throw new Exception("Featured image is required");
        }

        if (!$product_name) {
            throw new Exception("Name is required");
        }


        if (!$product_slug) {
            throw new Exception("Slug is required");
        }

        // if upload photo
        $imgs = upload_images($_FILES, ['width' => 350, 'height' => 400]);


        if (count($imgs) > 0) {
            $imgs = json_encode($imgs);

            $sqlForUploadingPhoto = "INSERT INTO products (name, featured_photo) VALUES ('$product_name', '$imgs')";
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
        var_dump($error_message);
        die();
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
                                        <input type="file" class="mt_10" name="photo" id="photo">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">Product Name *</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="short_description" class="form-label">Short Description*</label>
                                        <textarea name="short_description" class="form-control" cols="30" rows="5"
                                            id="short_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description *</label>
                                        <textarea name="description" class="form-control h_100" cols="30" rows="10"
                                            id="description"></textarea>
                                    </div>

                                    <div class="d-flex flex-wrap row-2-form">
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="slug" class="form-label">Slug *</label>
                                                <input type="text" class="form-control" name="slug" id="slug">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="price" class="form-label">Price *</label>
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
                                                <label for="sku" class="form-label">SKU</label>
                                                <input type="text" class="form-control" name="sku" id="sku">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="size" class="form-label">Size</label>
                                                <input type="text" class="form-control" name="size" id="size">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="color" class="form-label">Color</label>
                                                <input type="text" class="form-control" name="color" id="color">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="capacity" class="form-label">Capacity</label>
                                                <input type="text" class="form-control" name="capacity" id="capacity">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="weight" class="form-label">Weight</label>
                                                <input type="text" class="form-control" name="weight" id="weight">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="pocket" class="form-label">Pocket</label>
                                                <input type="text" class="form-control" name="pocket" id="pocket">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="water_resistant" class="form-label">Water Resistant</label>
                                                <select class="form-control" name="water_resistant"
                                                    id="water_resistant">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="warranty" class="form-label">Warranty in Years</label>
                                                <input type="text" class="form-control" name="warranty" id="warranty">
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