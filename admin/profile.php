<?php
include('../components/uploads.php');

include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');

if (!isset($_SESSION['admin'])) {

    $redirectUrl = ADMIN_URL . "login.php";

    header("Location: $redirectUrl");
}


if (isset($_POST['form_edit_profile'])) {
    try {
        $user_id = $_SESSION['admin']['id'];
        $first_name = $_POST['first_name'] ?? $_SESSION['admin']['first_name'];
        $last_name = $_POST['last_name'] ?? $_SESSION['admin']['last_name'];

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // if upload photo
        $imgs = upload_images($_FILES);

        if (count($imgs) > 0) {
            $imgs = json_encode($imgs);

            $sqlForUploadingPhoto = "UPDATE users SET photo='$imgs' WHERE id='$user_id'";
            $resultForUploadingPhoto = $pdo->query($sqlForUploadingPhoto);

            if ($resultForUploadingPhoto->rowCount() > 0) {

                $success_message3 = "Upload photo successfully";

            } else {
                throw new Exception("Photo upload error");
            }

        }

        // change password
        if (!empty($password) || !empty($confirm_password)) {
            // check if password matches
            if ($password != $confirm_password) {
                throw new Exception("Passwords doesn't matched");
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sqlForUpdatingPw = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
            $resultForUpdatingPw = $pdo->query($sqlForUpdatingPw);

            if ($resultForUpdatingPw->rowCount() == 1) {
                $success_message2 = "Password is updated.";
            }
        }

        // updating either first name or last name
        if ($first_name != $_SESSION['admin']['first_name'] || $last_name != $_SESSION['admin']['last_name']) {
            $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name' WHERE id='$user_id'";
            $result = $pdo->query($sql);

            // success
            if ($result->rowCount() > 0) {
                $success_message = "Basic info are updated.";
                $_SESSION["admin"]["first_name"] = $first_name;
                $_SESSION["admin"]["last_name"] = $last_name;
            } else {
                throw new Exception("Wasn't able to update your basic data");
            }

        }

    } catch (\Throwable $th) {
        $error_message = $th->getMessage();
    }
}

$admin_photo = get_photo($_SESSION["admin"]["photo"]);


?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($error_message)) { ?>
                                <span class="text-danger d-flex align-items-center gap-1 mb-2">
                                    <span class="material-icons">error</span>
                                    <?= $error_message; ?>
                                </span>
                            <?php }
                            if (isset($success_message)) { ?>
                                <span class="text-success d-flex align-items-center gap-1 mb-2">
                                    <span class="material-icons">check</span>
                                    <?= $success_message; ?>
                                </span>
                            <?php }

                            if (isset($success_message3)) { ?>
                                <span class="text-success d-flex align-items-center gap-1 mb-2">
                                    <span class="material-icons">check</span>
                                    <?= $success_message3; ?>
                                </span>
                            <?php }

                            if (isset($success_message2)) { ?>
                                <span class="text-success d-flex align-items-center gap-1 mb-2 block">
                                    <span class="material-icons">check</span>
                                    <?= $success_message2; ?>
                                </span>
                            <?php } ?>



                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php if ($_SESSION['admin']['photo']) { ?>
                                            <img alt="image" src="<?= $admin_photo ?>" class="profile-photo w_100_p">
                                        <?php } else { ?>
                                            <img alt="image" src="uploads/default.png" class="profile-photo w_100_p">
                                        <?php } ?>

                                        <input type="file" class="mt_10" name="photo">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <label class="form-label">First Name *</label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="<?= $_SESSION['admin']['first_name'] ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Last Name *</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="<?= $_SESSION['admin']['last_name'] ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" name="confirm_password">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-primary"
                                                name="form_edit_profile">Update</button>
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