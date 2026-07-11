<?php

include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');
include('./components/is_admin.php');

// product
$id = $_REQUEST['id'];

if ($id == "") {
    $error_message = "Product ID is required";
    $_SESSION['error_message'] = $error_message;

    $url = ADMIN_URL . "product-view.php";
    header("Location: $url");
    exit;
}

$sql = "SELECT * FROM products WHERE id='{$id}'";
$query = $pdo->query($sql);

$url = ADMIN_URL . "product-photo-gallery.php?id={$id}";

if ($query->rowCount() <= 0) {
    header("Location: $url");
}


// submit form for uploading a photo
if (isset($_POST['form_upload_product_gallery'])) {
    try {
        // Handle photo upload logic here
        $photo = $_FILES['photo'];

        if ($photo['size'] <= 0) {
            throw new Exception("Upload atleast 1 image");
        }

        // if upload photo
        $imgs = upload_images($_FILES, ['width' => 350, 'height' => 400]);

        if (count($imgs) > 0) {

            $imgs = json_encode($imgs);

            $sqlForUploadingPhoto = "INSERT INTO product_gallery (product_id, photo) VALUES ('$id','$imgs')";
            $query = $pdo->query($sqlForUploadingPhoto);

            if ($query->rowCount() > 0) {
                $_SESSION['success_message'] = "Photo uploaded successfully";
            } else {
                throw new Exception("Failed to upload photo. Please try again.");
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
            <h1>Photo Gallery</h1>
            <span class="material-symbols-outlined">image</span>
            <span class="ml-2 d-inline-block">ID:
                <?= $_REQUEST['id'] ?? '' ?>
            </span>


        </div>
        <div class="section-body">
            <div class="row">
                <!-- add photo -->
                <div class="col-md-3 col-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" enctype="multipart/form-data">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="photo" class="form-label">Upload a photo: *</label>
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
                <!-- table -->
                <div class="col-md-9 col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $photos = []; // photos
                                        
                                        $sqlForPhotos = "SELECT * FROM product_gallery WHERE product_id='$id'";
                                        $photoQuery = $pdo->query($sqlForPhotos);

                                        if ($photoQuery->rowCount() > 0) {
                                            $photos = $photoQuery->fetchAll(PDO::FETCH_ASSOC);
                                            for ($i = 0; $i < count($photos); $i++) {
                                                $photo_id = $photos[$i]['id'];
                                                $photo = get_thumb($photos[$i]['photo']);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $i + 1 ?>
                                                    </td>
                                                    <td><img src="<?= $photo ?>" alt="photo-<?= $photo_id ?>" width="100">
                                                    </td>
                                                    <td class="pt_9 pb_10 ">
                                                        <a href="<?= ADMIN_URL ?>product-photo-gallery-delete.php?photo_id=<?= $photo_id ?>&product_id=<?= $id ?>"
                                                            class="btn btn-danger" onClick="return confirm('Are you sure?');"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>



                                        <?php }
                                        ?>

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