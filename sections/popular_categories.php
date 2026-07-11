<!-- Popular categories-->
<section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
    <div class="row">
        <div class="col-xl-8 col-lg-9">

            <div class="card border-0 shadow-lg">
                <div class="card-body px-3 pt-grid-gutter pb-0">
                    <div class="row g-0 ps-1">
                        <?php
                        $sql = "SELECT * FROM product_categories";
                        $query = $pdo->query($sql);


                        if ($query->rowCount() > 0) {
                            $product_categories = $query->fetchAll(PDO::FETCH_ASSOC);

                            for ($i = 0; $i < count($product_categories); $i++) {
                                if ($i <= 2) {
                                    $product_name = $product_categories[$i]['name'];
                                    $product_img = get_thumb($product_categories[$i]['photo']);
                                }
                                ?>
                                <div class="col-sm-4 px-2 mb-grid-gutter"><a
                                        class="d-block text-center text-decoration-none me-1" href="shop-grid-ls.html"><img
                                            class="d-block rounded mb-3" src="<?= ADMIN_URL . $product_img ?>"
                                            alt="<?= $product_name ?>">
                                        <h3 class="fs-base pt-1 mb-0">
                                            <?= $product_name ?>
                                        </h3>
                                    </a></div>
                            <?php }

                        } else {
                            echo "<p class='text-center'>No categories found.</p>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>