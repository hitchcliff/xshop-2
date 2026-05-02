<?php
include('./templates/header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['customer_forget_password'])) {
  try {
    $email = $_POST['email'];


    if ($email == "") {
      throw new Exception('Email cannot be empty');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception('Email is invalid');
    }
    // check database

    $sql = "SELECT * FROM customers WHERE email='{$email}' AND role='customer'";
    $query = $pdo->query($sql);


    if ($query->rowCount() <= 0) {
      throw new Exception("Account doesn't exists");
    }

    $token = time();

    // set the token to the user
    $sql2 = "UPDATE customers SET token='$token' WHERE email='$email'";
    $query2 = $pdo->query($sql2);

    // html
    $email_message = '<a href="' . BASE_URL . 'reset-password.php?email=' . $email . '&token=' . $token . '">Reset Password</a>';

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
    $_SESSION['success_message'] = $success_message;

  } catch (\Throwable $th) {
    $error_message = $th->getMessage();
    $_SESSION['error_message'] = $error_message;
  }

}

?>

<div class="container py-4 py-lg-5 my-4">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <h2 class="h3 mb-4">Forgot your password?</h2>
      <p class="fs-md">Change your password in three easy steps. This helps to keep your new password secure.</p>
      <ol class="list-unstyled fs-md">
        <li><span class="text-primary me-2">1.</span>Fill in your email address below.</li>
        <li><span class="text-primary me-2">2.</span>We'll email you a temporary code.</li>
        <li><span class="text-primary me-2">3.</span>Use the code to change your password on our secure website.</li>
      </ol>
      <div class="card py-2 mt-4">
        <form method="POST" class="card-body needs-validation" novalidate action="">
          <div class="mb-3">
            <label class="form-label" for="recover-email">Enter your email address</label>
            <input class="form-control" name="email" type="email" id="recover-email" autofocus required>
            <div class="invalid-feedback">Please provide valid email address.</div>
          </div>
          <button name="customer_forget_password" class="btn btn-primary" type="submit">Get new password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('./templates/footer.php'); ?>