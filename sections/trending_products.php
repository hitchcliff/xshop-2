<!-- Products grid (Trending products)-->
<section class="container pt-md-3 pb-5 mb-md-3">
    <h2 class="h3 text-center">Trending products</h2>
    <div class="row pt-4 mx-n2">
        <?php

        $products = [];

        $sql = "SELECT * FROM products ORDER BY total_sale DESC LIMIT 8";
        $query = $pdo->query($sql);

        if ($query->rowCount() > 0) {
            $products = $query->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($products); $i++) {
                $product_id = $products[$i]['id'];
                $product_name = $products[$i]['name'];
                $product_slug = $products[$i]['slug'];
                $product_quantity = $products[$i]['quantity'];
                $product_price = $products[$i]['regular_price'];
                $product_sale_price = $products[$i]['sale_price'];
                $product_short_description = $products[$i]['short_description'];
                $product_description = $products[$i]['description'];
                $product_sku = $products[$i]['sku'];
                $product_size = $products[$i]['size'];
                $product_color = $products[$i]['color'];
                $product_capacity = $products[$i]['capacity'];
                $product_weight = $products[$i]['weight'];
                $product_pocket = $products[$i]['pocket'];
                $product_water_resistant = $products[$i]['water_resistant'];
                $product_warranty = $products[$i]['warranty'];
                $product_total_sales = $products[$i]['total_sale'];
                $product_img = get_photo($products[$i]['featured_photo']);
                $product_category = get_product_category($pdo, $products[$i]['product_category_id']);
                ?>

                <!-- Product-->
                <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden"
                            href="product.php?id=<?= $product_id ?>&slug=<?= $product_slug ?>"><img
                                src="<?= ADMIN_URL . $product_img ?>" alt="<?= $product_name ?>"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="#"><?= $product_category ?></a>
                            <h3 class="product-title fs-sm"><a href="shop-single-v1.html"><?= $product_name ?></a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span
                                        class="text-accent">₱<?= number_format($product_price, 2) ?></span></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-half active"></i><i
                                        class="star-rating-icon ci-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">
                            <!-- <div class="text-center pb-2">
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-75">
                                    <label class="form-option-label" for="s-75">7.5</label>
                                </div>
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-80" checked>
                                    <label class="form-option-label" for="s-80">8</label>
                                </div>
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-85">
                                    <label class="form-option-label" for="s-85">8.5</label>
                                </div>
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-90">
                                    <label class="form-option-label" for="s-90">9</label>
                                </div>
                            </div> -->
                            <form action="" method="post">
                                <button type="submit" name="form_add_to_cart" class="btn btn-primary btn-sm d-block w-100 mb-2"
                                    type="button"><i class="ci-cart fs-sm me-1"></i>Add
                                    to Cart</button>
                            </form>
                            <!-- <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view"
                                    data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div> -->
                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>No products found.</p>";
        }
        ?>

    </div>
    <div class="text-center pt-3"><a class="btn btn-outline-accent" href="shop-grid-ls.html">More products<i
                class="ci-arrow-right ms-1"></i></a></div>
</section>