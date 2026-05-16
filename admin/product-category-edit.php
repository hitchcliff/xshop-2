<?php

include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');

if (!isset($_SESSION['admin'])) {

    $redirectUrl = ADMIN_URL . "login.php";

    header("Location: $redirectUrl");
}

// product
$id = $_REQUEST['id'];

$sql = "SELECT * FROM product_categories WHERE id='{$id}'";
$query = $pdo->query($sql);

$url = ADMIN_URL . "product-category-view.php";
if ($query->rowCount() <= 0) {
    header("Location: $url");
}

$product_category = $query->fetch(PDO::FETCH_ASSOC);
$product_img = get_thumb($product_category['photo']);
$product_name = $product_category['name'];

// edit category
if (isset($_POST['form_edit_category'])) {
    try {
        $category_name = $_POST['name'];

        // if there is a NEW PHOTO uploaded
        if ($_FILES['photo']['size'] > 0) {

            // if upload photo
            $imgs = upload_images($_FILES, ['width' => 350, 'height' => 400]);

            if (count($imgs) > 0) {
                $imgs = json_encode($imgs);

                $sqlForUploadingPhoto = "UPDATE product_categories SET photo='$imgs' WHERE id='$id'";
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
        $sql = "UPDATE product_categories SET name='$category_name' WHERE id='$id'";
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
            <h1>Edit Profile</h1>

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
                                            <label class="form-label">Category Name *</label>
                                            <input type="text" class="form-control" name="name"
                                                value="<?= $product_name ?>">
                                        </div>
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary" name="form_edit_category">Edit
                                                Category</button>
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