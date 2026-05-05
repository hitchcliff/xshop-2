<?php
include('./templates/header.php');

$email = $_REQUEST["email"];
$token = $_REQUEST["token"];
$sql = "SELECT * FROM customers WHERE email='$email' AND token='$token'";
$query = $pdo->query($sql);

$loginUrl = BASE_URL . "account-signin.php";

if ($query->rowCount() > 0) {
  $row = $query->fetch(PDO::FETCH_ASSOC);
} else {
  header("Location: $loginUrl");
}

if (isset($_POST["customer_reset_password"])) {
  try {
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($password) || empty($confirm_password)) {
      throw new Exception("Passwords cannot be empty");
    }

    if ($password != $confirm_password) {
      throw new Exception("Password does not match");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user_id = $row['id'];
    $sql2 = "UPDATE customers SET password='$hashed_password',  token=null WHERE id='$user_id'";
    $query2 = $pdo->query($sql2);

    if ($query2->rowCount() > 0) {
      $success_message = "Password changed successfully, you can now login with your new password.";
      $_SESSION['success_message'] = $success_message;
      header("Location: $loginUrl");
      exit;
    }

  } catch (\Throwable $th) {
    $error_message = $th->getMessage();
    $_SESSION['error_message'] = $error_message;
  }

}

?>

<div class="container py-4 py-lg-5 my-4">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <h2 class="h3 mb-4">Reset your password?</h2>
      <div class="card py-2 mt-4">
        <form method="POST" class="card-body needs-validation" novalidate action="">
          <div class="mb-3">
            <label class="form-label" for="recover-password">Password</label>
            <input class="form-control" name="password" type="password" id="recover-password" autofocus required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="recover-password-2">Confirm Password</label>
            <input class="form-control" name="confirm_password" type="password" id="recover-password-2" required>
          </div>
          <button name="customer_reset_password" class="btn btn-primary" type="submit">Change password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('./templates/footer.php'); ?>