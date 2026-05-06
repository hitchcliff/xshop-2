<?php
include('./templates/header.php');

$_SESSION['page_title'] = "Profile Info";

if (isset($_POST['form_profile'])) {



  try {
    $user_id = $_SESSION['customer']['id'];
    $first_name = $_POST['first_name'] ?? $_SESSION['customer']['first_name'];
    $last_name = $_POST['last_name'] ?? $_SESSION['customer']['last_name'];
    $phone_number = $_POST['phone_number'] ?? $_SESSION['customer']['phone_number'];
    $email = $_POST['email'] ?? $_SESSION['customer']['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception('Email is invalid');
    }

    $sql = "SELECT * FROM customers WHERE id='{$user_id}'";
    $query = $pdo->query($sql);

    if ($query->rowCount() <= 0) {
      throw new Exception('Customer not found');
    }


    // update 
    $sql2 = "UPDATE customers SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number' WHERE id='{$user_id}'";
    $query2 = $pdo->query($sql2);
    $result = $query2->fetchAll(PDO::FETCH_ASSOC);

    $success_message = "Profile updated successfully";
    $_SESSION['success_message'] = $success_message;

    // update the session with the new data 
    $_SESSION['customer']['first_name'] = $first_name;
    $_SESSION['customer']['last_name'] = $last_name;
    $_SESSION['customer']['phone_number'] = $phone_number;
    $_SESSION['customer']['email'] = $email;


  } catch (\Throwable $th) {
    //throw $th;
    $error_message = $th->getMessage();
    $_SESSION['error_message'] = $error_message;
  }



}

?>


<!-- Page Title-->
<?php include('./templates/page-title.php'); ?>


<div class="container pb-5 mb-2 mb-md-4">
  <div class="row">
    <!-- Sidebar-->
    <?php include('./templates/sidebar.php'); ?>

    <!-- Content  -->
    <section class="col-lg-8">

      <!-- Profile form-->
      <form method="post" class="needs-validation" novalidate>
        <div class="bg-secondary rounded-3 p-4 mb-4">
          <div class="d-flex align-items-center"><img class="rounded"
              src="<?php BASE_URL ?>dist-front/img/shop/account/avatar.jpg" width="90" alt="Susan Gardner">
            <div class="ps-3">
              <button class="btn btn-light btn-shadow btn-sm mb-2" type="button"><i class="ci-loading me-2"></i>Change
                avatar</button>
              <div class="p mb-0 fs-ms text-muted">Upload JPG, GIF or PNG image. 300 x 300 required.</div>
            </div>
          </div>
        </div>
        <div class="row gx-4 gy-3">
          <div class="col-sm-6">
            <label class="form-label" for="account-fn">First Name</label>
            <input class="form-control" name="first_name" type="text" id="account-fn"
              value="<?php echo $_SESSION['customer']['first_name'] ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="account-ln">Last Name</label>
            <input class="form-control" name="last_name" type="text" id="account-ln"
              value="<?php echo $_SESSION['customer']['last_name'] ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="account-email">Email Address</label>
            <input class="form-control" name="email" type="email" id="account-email"
              value="<?php echo $_SESSION['customer']['email'] ?>">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="account-phone">Phone Number</label>
            <input class="form-control" name="phone_number" type="text" id="account-phone"
              value="<?php echo $_SESSION['customer']['phone_number'] ? $_SESSION['customer']['phone_number'] : '' ?>">
          </div>
          <!-- <div class="col-sm-6">
            <label class="form-label" for="account-pass">New Password</label>
            <div class="password-toggle">
              <input class="form-control" name="password" type="password" id="account-pass">
              <label class="password-toggle-btn" aria-label="Show/hide password">
                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
              </label>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="account-confirm-pass">Confirm Password</label>
            <div class="password-toggle">
              <input class="form-control" name="confirm_password" type="password" id="account-confirm-pass">
              <label class="password-toggle-btn" aria-label="Show/hide password">
                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
              </label>
            </div>
          </div> -->
          <div class="col-12">
            <!-- <hr class="mt-2 mb-3"> -->
            <div class="d-flex flex-wrap justify-content-between align-items-center">
              <!-- <div class="form-check">
                <input class="form-check-input" type="checkbox" id="subscribe_me" checked>
                <label class="form-check-label" for="subscribe_me">Subscribe me to Newsletter</label>
              </div> -->
              <button name="form_profile" class="btn btn-primary mt-3 mt-sm-0" type="submit">Update profile</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
</div>
<?php include('./templates/footer.php') ?>