<?php

include('./components/header.php');

// echo $_SERVER;

if (isset($_POST['form_login'])) {
    try {
        if ($_POST['email'] == "") {
            throw new Exception('Email cannot be empty');
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
                        <h4 class="text-center">Admin Panel Login</h4>
                    </div>
                    <div class="card-body card-body-auth">

                        <?php if (isset($error_message)) { ?>
                            <span class="text-danger d-flex align-items-center gap-1 mb-2">
                                <span class="material-icons">error</span>
                                <?= $error_message; ?>
                            </span>

                        <?php } ?>



                        <form method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address"
                                    value="" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg w_100_p" name="form_login">
                                    Login
                                </button>
                            </div>
                            <div class="form-group">
                                <div>
                                    <a href="forget-password.html">
                                        Forget Password?
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

<?php include('./components/footer.php') ?>