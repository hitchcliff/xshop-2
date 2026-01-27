<?php

include('./components/header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['form_forget_password'])) {
    try {
        $email = $_POST['email'];

        if ($email == "") {
            throw new Exception('Email cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email is invalid');
        }
        // check database

        $sql = "SELECT * FROM users WHERE email='{$email}' AND role='admin'";
        $query = $pdo->query($sql);

        if ($query->rowCount() <= 0) {
            throw new Exception("Account doesn't exists");
        }

        try {
            $token = time();
            // html
            $email_message = '<a href="' . ADMIN_URL . 'reset-password.php?email=' . $email . '&token=' . $token . '">Reset Password</a>';

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = SMTP_ENCRYPTION;
            $mail->Port = SMTP_PORT;
            $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Reset Password";
            $mail->Body = $email_message;
            $mail->send();

            // to be displayed in the ui
            $success_message = "Success! Recovery link sent to your email";

        } catch (\Throwable $th) {
            throw new Exception("Mail error: " . $th->getMessage());

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


                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address"
                                    value="" autofocus>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg w_100_p"
                                    name="form_forget_password">
                                    Send Password Reset Link
                                </button>
                            </div>
                            <div class="form-group">
                                <div>
                                    <a href="login.php">
                                        Back to login page
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

<?php include('./components/footer.php'); ?>