<?php

include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');
include('./components/is_admin.php');

// NOTE
// ONLY THE SLUG AND NAME CAN BE EDITED FOR NOW

// product
$id = $_REQUEST['id'];

$sql = "SELECT * FROM products WHERE id='{$id}'";
$query = $pdo->query($sql);

$url = ADMIN_URL . "product-view.php";
if ($query->rowCount() <= 0) {
    header("Location: $url");
}


$product = $query->fetch(PDO::FETCH_ASSOC);

$product_img = get_thumb($product['featured_photo']);
$product_name = $_POST['name'] ?? $product['name'];
$product_slug = $_POST['slug'] ?? $product['slug'];
$product_category_id = $_POST['category_id'] ?? $product['product_category_id'];
$product_short_description = $_POST['short_description'] ?? $product['short_description'];
$product_description = $_POST['description'] ?? $product['description'];
$product_price = $_POST['price'] ?? $product['regular_price'];
$product_sale_price = $_POST['sale_price'] ?? $product['sale_price'];
$product_quantity = $_POST['quantity'] ?? $product['quantity'];
$product_sku = $_POST['sku'] ?? $product['sku'];
$product_size = $_POST['size'] ?? $product['size'];
$product_color = $_POST['color'] ?? $product['color'];
$product_capacity = $_POST['capacity'] ?? $product['capacity'];
$product_weight = $_POST['weight'] ?? $product['weight'];
$product_pocket = $_POST['pocket'] ?? $product['pocket'];
$product_water_resistant = $_POST['water_resistant'] ?? $product['water_resistant'];
$product_warranty = $_POST['warranty'] ?? $product['warranty'];


// edit category
if (isset($_POST['form_edit_product'])) {
    try {

        // if there is a NEW PHOTO uploaded
        if ($_FILES['photo']['size'] > 0) {

            // if upload photo
            $imgs = upload_images($_FILES, ['width' => 350, 'height' => 400]);

            if (count($imgs) > 0) {
                $imgs = json_encode($imgs);

                $sqlForUploadingPhoto = "UPDATE products SET featured_photo='$imgs' WHERE id='$id'";
                $resultForUploadingPhoto = $pdo->query($sqlForUploadingPhoto);

                if ($resultForUploadingPhoto->rowCount() > 0) {
                    $success_message = "Upload photo successfully";
                    $_SESSION['success_message'] = $success_message;
                } else {
                    throw new Exception("Photo upload error");
                }

            }
        }

        // UPDATE Text Fields
        $sql = "UPDATE products SET name='$product_name', slug='$product_slug' WHERE id='$id'";
        $result = $pdo->query($sql);

        // success
        if ($result->rowCount() > 0) {
            $success_message = "Updated successfully";
            $_SESSION['success_message'] = $success_message;
            header("Location: $url");
            exit;
        } else {
            throw new Exception("Not updated");
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
            <h1>Edit Product</h1>

            <span class="material-symbols-outlined">settings</span>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="col">
                                    <div class="mb-4">
                                        <label class="form-label bold d-block">Existing photo:</label>
                                        <img src="<?= $product_img ?>" alt="<?= $product_name ?>" width="100">
                                    </div>
                                    <div class="mb-4">
                                        <input type="file" class="mt_10" name="photo">
                                    </div>
                                    <div class="">
                                        <div class="mb-4">
                                            <label class="form-label">Product Name *</label>
                                            <input type="text" class="form-control" name="name"
                                                value="<?= $product_name ?>">
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
                                            <textarea name="description" class="form-control h_100" cols="30" rows="10"
                                                id="description"><?= $product_description ?? "" ?></textarea>
                                        </div>

                                        <div class="d-flex flex-wrap row-2-form">
                                            <div class="col-md-6 col-12">
                                                <div class="">
                                                    <label for="slug" class="form-label">Slug *</label>
                                                    <input type="text" class="form-control" name="slug" id="slug"
                                                        value="<?= $product_slug ?? "" ?>">
                                                </div>
                                            </div>
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
                                                    <input type="text" class="form-control" name="quantity"
                                                        id="quantity" value="<?= $product_quantity ?? "" ?>">
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
                                                    <input type="text" class="form-control" name="capacity"
                                                        id="capacity" value="<?= $product_capacity ?? "" ?>">
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
                                                    <label for="water_resistant" class="form-label">Water
                                                        Resistant</label>
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
                                                    <input type="text" class="form-control" name="warranty"
                                                        id="warranty" value="<?= $product_warranty ?? "" ?>">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary" name="form_edit_product">Edit
                                                Product</button>
                                        </div>
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