<?php

include('./templates/header.php');

$redirectUrl = BASE_URL . 'account-signin.php';

if (!($_GET['email']) || !($_GET['token'])) {


    header("Location: $redirectUrl");
    exit();
}

// check for the user
$email = $_GET['email'];
$token = $_GET['token'];
$sql = "SELECT * FROM customers WHERE email='$email' AND token='$token'";
$query = $pdo->query($sql);

// cannot find
if ($query->rowCount() == 0) {
    header("Location: $redirectUrl");
    exit();
}

$newToken = bin2hex(random_bytes(12));

// update the status and assign new token
$sql = "UPDATE customers SET status='active', token='$newToken' WHERE email='$email' AND token='$token'";
$query = $pdo->query($sql);

if ($query->rowCount() > 0) {
    $success_message = "You account has been activated! You may login now";
    $_SESSION['success_message'] = $success_message;
    header("Location: $redirectUrl");
    exit();
}

?>


<div class="container py-4 py-lg-5 my-4">
    <div class="row">
        <div class="col-md-12">
            <a href="index.php" class="btn btn-primary d-inline-flex w-auto gap-2">
                <span class="material-symbols-outlined">
                    arrow_back
                </span>
                Go back to login page</a>
        </div>
    </div>
</div>

<?php include("./templates/footer.php") ?>