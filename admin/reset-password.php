<?php

include("./components/header.php");

$email = $_REQUEST["email"];
$token = $_REQUEST["token"];
$sql = "SELECT * FROM users WHERE email='$email' AND token='$token'";
$query = $pdo->query($sql);

$loginUrl = ADMIN_URL . "login.php";

if ($query->rowCount() > 0) {
    $row = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: $loginUrl");
}

if (isset($_POST["form_forget_password"])) {
    try {
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if (empty($password) || empty($confirm_password)) {
            throw new Exception("Passwords cannot be empty");
        }

        if ($password != $confirm_password) {
            throw new Exception("Password doesn't match");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $user_id = $row['id'];
        $sql2 = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
        $query2 = $pdo->query($sql2);

        if ($query2->rowCount() > 0) {
            $success_message = "Password changed successfully, you can now login with your new password.";
        }

    } catch (\Throwable $th) {
        $error_message = $th->getMessage();
    }

}


?>

<section class="section">
    <div class="container container-login">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary border-box">
                    <div class="card-header card-header-auth">
                        <h4 class="text-center">Reset Password</h4>
                    </div>
                    <div class="card-body card-body-auth">


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
                        <?php } ?>


                        <form method="POST">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    value="" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="Retype Password" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg w_100_p"
                                    name="form_forget_password">
                                    Submit
                                </button>
                            </div>
                            <div class="form-group">
                                <div>
                                    <a href="login.php">
                                        Login
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./components/footer.php") ?>