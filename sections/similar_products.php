<div class="container py-5 my-md-3">
    <h2 class="h3 text-center pb-4">You may also like</h2>
    <div class="tns-carousel tns-controls-static tns-controls-outside">
        <div class="tns-carousel-inner"
            data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: true, &quot;nav&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;768&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;items&quot;:4, &quot;gutter&quot;: 30}}}">
            <?php
            $category_id = $product['product_category_id']; // Get the category ID of the current product

            $sql = "SELECT * FROM products WHERE product_category_id='$category_id' LIMIT 8";
            $query = $pdo->query($sql);

            if ($query->rowCount() > 0) {
                $products = $query->fetchAll(PDO::FETCH_ASSOC);


                for ($i = 0; $i < count($products); $i++) {
                    $similar_product_id = $products[$i]['id'];
                    $similar_product_name = $products[$i]['name'];
                    $similar_product_slug = $products[$i]['slug'];
                    $similar_product_price = $products[$i]['regular_price'];
                    $similar_product_sale_price = $products[$i]['sale_price'];
                    $similar_product_img = ADMIN_URL . get_photo($products[$i]['featured_photo']);

                    ?>

                    <!-- Product-->
                    <div>
                        <div class="card product-card card-static">
                            <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to wishlist"><i class="ci-heart"></i></button><a
                                class="card-img-top d-block overflow-hidden" href="#"><img src="<?= $similar_product_img ?>"
                                    alt="Product"></a>
                            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                    href="#"><?= $similar_product_name ?></a>
                                <h3 class="product-title fs-sm"><a href="#"><?= $similar_product_slug ?></a></h3>
                                <div class="d-flex justify-content-between">
                                    <div class="product-price"><span class="text-accent">₱
                                            <?= $similar_product_price ?>
                                        </span></div>
                                    <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                                            class="star-rating-icon ci-star-filled active"></i><i
                                            class="star-rating-icon ci-star-filled active"></i><i
                                            class="star-rating-icon ci-star-half active"></i><i
                                            class="star-rating-icon ci-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php }
            } ?>


        </div>
    </div>
</div>