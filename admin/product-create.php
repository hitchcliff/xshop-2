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
        $product_slug = generateSlug($product_name);
        $product_category_id = $_POST['category_id'];
        $product_photo = $_FILES['photo'];
        $product_short_description = $_POST['short_description'];
        $product_description = $_POST['description'];
        $product_price = $_POST['price'];
        $product_sale_price = $_POST['sale_price'];
        $product_quantity = $_POST['quantity'];
        $product_sku = $_POST['sku'];
        $product_size = $_POST['size'];
        $product_color = $_POST['color'];
        $product_capacity = $_POST['capacity'];
        $product_weight = $_POST['weight'];
        $product_pocket = $_POST['pocket'];
        $product_water_resistant = $_POST['water_resistant'];
        $product_warranty = $_POST['warranty'];

        if ($product_photo['size'] <= 0) {
            throw new Exception("Featured image is required");
        }

        if (!$product_name) {
            throw new Exception("Name is required");
        }

        if (!$product_category_id) {
            throw new Exception("Category is required");
        }

        if (!$product_short_description) {
            throw new Exception("Short description is required");
        }

        if (!$product_description) {
            throw new Exception("Product Description is required");
        }

        if (!$product_slug) {
            throw new Exception("Slug is required");
        }

        if (!$product_price) {
            throw new Exception("Price is required");
        }

        // if upload photo
        $imgs = upload_images($_FILES, ['width' => 350, 'height' => 400]);

        if (count($imgs) > 0) {
            $imgs = json_encode($imgs);

            $sqlForUploadingPhoto = "INSERT INTO products (name, featured_photo, product_category_id, slug, quantity, regular_price, sale_price, short_description, description, sku, size, color, capacity, weight, pocket, water_resistant, warranty) 
            VALUES ('$product_name', '$imgs', '$product_category_id', '$product_slug', '$product_quantity', '$product_price', '$product_sale_price', '$product_short_description', '$product_description', '$product_sku', '$product_size', '$product_color', '$product_capacity', '$product_weight', '$product_pocket', '$product_water_resistant', '$product_warranty')";

            $resultForUploadingPhoto = $pdo->query($sqlForUploadingPhoto);

            if ($resultForUploadingPhoto->rowCount() > 0) {
                $success_message = "Upload photo successfully";
                $_SESSION['success_message'] = $success_message;

                // remove the values
                $product_name = "";
                $product_slug = "";
                $product_category_id = "";
                $product_short_description = "";
                $product_description = "";
                $product_price = "";
                $product_sale_price = "";
                $product_quantity = "";
                $product_sku = "";
                $product_size = "";
                $product_color = "";
                $product_capacity = "";
                $product_weight = "";
                $product_pocket = "";
                $product_water_resistant = "";
                $product_warranty = "";
            } else {
                throw new Exception("Photo upload error");
            }

        }

    } catch (\Throwable $th) {
        $error_message = $th->getMessage();
        $_SESSION['error_message'] = $error_message;
        var_dump($error_message);

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
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="<?= $product_name ?? "" ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id" class="form-label">Category *</label>
                                        <?php include('./components/select_category.php'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="short_description" class="form-label">Short Description*</label>
                                        <textarea name="short_description" class="form-control" cols="30" rows="5"
                                            id="short_description"><?= $product_short_description ?? "" ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description *</label>
                                        <textarea name="description" class="form-control editor" cols="30" rows="10"
                                            id="description"><?= $product_description ?? "" ?></textarea>
                                    </div>

                                    <div class="d-flex flex-wrap row-2-form">
                                        <!-- <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="slug" class="form-label">Slug *</label>
                                                <input type="text" class="form-control" name="slug" id="slug"
                                                    value="<?= $product_slug ?? "" ?>">
                                            </div>
                                        </div> -->
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="price" class="form-label">Price *</label>
                                                <input type="text" class="form-control" name="price" id="price"
                                                    value="<?= $product_price ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="sale_price" class="form-label">Sale Price</label>
                                                <input type="text" class="form-control" name="sale_price"
                                                    id="sale_price" value="<?= $product_sale_price ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input type="text" class="form-control" name="quantity" id="quantity"
                                                    value="<?= $product_quantity ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="sku" class="form-label">SKU</label>
                                                <input type="text" class="form-control" name="sku" id="sku"
                                                    value="<?= $product_sku ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="size" class="form-label">Size</label>
                                                <input type="text" class="form-control" name="size" id="size"
                                                    value="<?= $product_size ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="color" class="form-label">Color</label>
                                                <input type="text" class="form-control" name="color" id="color"
                                                    value="<?= $product_color ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="capacity" class="form-label">Capacity</label>
                                                <input type="text" class="form-control" name="capacity" id="capacity"
                                                    value="<?= $product_capacity ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="weight" class="form-label">Weight</label>
                                                <input type="text" class="form-control" name="weight" id="weight"
                                                    value="<?= $product_weight ?? "" ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="">
                                                <label for="pocket" class="form-label">Pocket</label>
                                                <input type="text" class="form-control" name="pocket" id="pocket"
                                                    value="<?= $product_pocket ?? "" ?>">
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
                                                <input type="text" class="form-control" name="warranty" id="warranty"
                                                    value="<?= $product_warranty ?? "" ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 d-inline-block">
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