<?php


if (isset($_POST['form_customer_register'])) {
    try {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];



        if ($firstName == "") {
            throw new Exception('First name cannot be empty');
        }

        if ($lastName == "") {
            throw new Exception('Last name cannot be empty');
        }

        if ($email == "") {
            throw new Exception('Email cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email is invalid');
        }


        // check database
        $sql = "SELECT * FROM customers WHERE email='{$email}'";
        $query = $pdo->query($sql);

        if ($query->rowCount() > 0) {
            throw new Exception("Account already exists");
        }

        // register user
        if ($password == '') {
            throw new Exception('Password cannot be empty');
        }

        if ($password != $confirmPassword) {
            throw new Exception('Password does not match');
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(12));

        $sql2 =
            "INSERT INTO customers (first_name, last_name, email, password, token, role)
             VALUES ('$firstName', '$lastName', '$email', '$hashed_password', '$token', 'customer');";

        $query2 = $pdo->query($sql2);

        if ($query2->rowCount() > 0) {
            $success_message = "Sucessfully created the user!";
        }


    } catch (\Throwable $th) {
        $error_message = $th->getMessage();
    }
}

?>

<?php if (isset($error_message)) { ?>
    <span class="text-danger d-flex align-items-center gap-1 mb-2">
        <span class="material-icons">error</span>
        <?= $error_message; ?>
    </span>

<?php } ?>

<?php if (isset($success_message)) { ?>
    <span class="text-success d-flex align-items-center gap-1 mb-2">
        <span class="material-icons">check</span>
        <?= $success_message; ?>
    </span>

<?php } ?>

<form method="POST" class="needs-validation" novalidate>

    <div class="row gx-4 gy-3">
        <div class="col-sm-6">
            <label class="form-label" for="first_name">First Name</label>
            <input name="first_name" class="form-control" type="text" required id="first_name">
            <div class="invalid-feedback">Please enter your first name!</div>
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="last_name">Last Name</label>
            <input name="last_name" class="form-control" type="text" required id="last_name">
            <div class="invalid-feedback">Please enter your last name!</div>
        </div>
        <div class="col-sm-12">
            <label class="form-label" for="email">E-mail Address</label>
            <input name="email" class="form-control" type="email" required id="email">
            <div class="invalid-feedback">Please enter valid email address!</div>
        </div>
        <!-- <div class="col-sm-6">
            <label class="form-label" for="reg-phone">Phone Number</label>
            <input class="form-control" type="text" required id="reg-phone">
            <div class="invalid-feedback">Please enter your phone number!</div>
          </div> -->
        <div class="col-sm-6">
            <label class="form-label" for="password">Password</label>
            <input name="password" class="form-control" type="password" required id="password">
            <div class="invalid-feedback">Please enter password!</div>
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="confirm_password">Confirm Password</label>
            <input name="confirm_password" class="form-control" type="password" required id="confirm_password">
            <div class="invalid-feedback">Passwords do not match!</div>
        </div>
        <div class="col-12 text-end">
            <button name="form_customer_register" class="btn btn-primary" type="submit"><i
                    class="ci-user me-2 ms-n1"></i>Sign Up</button>
        </div>
    </div>
</form>