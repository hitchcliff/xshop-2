<?php


if (isset($_SESSION['customer'])) {
    $url = BASE_URL . "dashboard.php";
    header("Location: $url");
}

if (isset($_POST['form_customer_login'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email == "") {
            throw new Exception('Email cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email is invalid');
        }

        if ($password == '') {
            throw new Exception('Password cannot be empty');
        }

        // check database

        $sql = "SELECT * FROM customers WHERE email='{$email}' AND role='customer'";
        $query = $pdo->query($sql);

        if ($query->rowCount() <= 0) {

            $error_message = "Account doesn't exists";
            throw new Exception($error_message);
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            if (!password_verify($password, $row["password"])) {
                throw new Exception("Wrong password");
            } else {
                $_SESSION["customer"] = $row;
                $redirectUrl = BASE_URL . "dashboard.php";
                header("Location: $redirectUrl");

            }
        }


    } catch (\Throwable $th) {
        $error_message = $th->getMessage();
        $_SESSION['error_message'] = $error_message;
    }

}


?>

<form method="POST" class="needs-validation" novalidate>
    <div class="input-group mb-3"><i
            class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
        <input name="email" class="form-control rounded-start" type="email" placeholder="Email" required>
    </div>
    <div class="input-group mb-3"><i
            class="ci-locked position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
        <div class="password-toggle w-100">
            <input name="password" class="form-control" type="password" placeholder="Password" required>
            <label class="password-toggle-btn" aria-label="Show/hide password">
                <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
            </label>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-between">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" checked id="remember_me">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div><a class="nav-link-inline fs-sm" href="forget-password.php">Forgot password?</a>
    </div>
    <hr class="mt-4">
    <div class="text-end pt-4">
        <button name="form_customer_login" class="btn btn-primary" type="submit"><i
                class="ci-sign-in me-2 ms-n21"></i>Sign In</button>
    </div>
</form>