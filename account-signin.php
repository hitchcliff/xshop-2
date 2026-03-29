<?php include('./templates/header.php') ?>

<div class="container py-4 py-lg-5 my-4">
  <div class="row">
    <div class="col-md-6">
      <div class="card border-0 shadow">
        <div class="card-body">
          <h2 class="h4 mb-1">Sign in</h2>
          <?php include('./templates/login-form.php'); ?>
        </div>
      </div>
    </div>
    <div class="col-md-6 pt-4 mt-3 mt-md-0">
      <h2 class="h4 mb-3">No account? Sign up</h2>
      <p class="fs-sm text-muted mb-4">Registration takes less than a minute but gives you full control over your
        orders.</p>

      <?php include("./templates/register.php"); ?>
    </div>
  </div>
</div>

<?php include("./templates/footer.php") ?>