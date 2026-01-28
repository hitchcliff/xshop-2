<?php

$admin_photo = get_thumb($_SESSION['admin']['photo']);

?>

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right justify-content-end rightsidetop align-items-center">
        <li class="nav-link">
            <a href="" target="_blank" class="btn btn-warning">Front End</a>
        </li>
        <li class="nav-link">
            <span>Logged in as:
                <span class="text-capitalize fw-bold">
                    <?= $_SESSION['admin']['first_name'] ?>
                </span>
                <span class="text-capitalize ml-2 fw-bold">
                    <?= $_SESSION['admin']['last_name'] ?>
                </span>
            </span>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                <?php if ($_SESSION['admin']['photo']) { ?>
                    <img alt="image" src="<?= $admin_photo ?>" class="rounded-circle-custom">
                <?php } else { ?>
                    <img alt="image" src="uploads/default.png" class="rounded-circle-custom">
                <?php } ?>

            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.php"><i class="far fa-user"></i> Edit Profile</a></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>