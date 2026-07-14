<?php include 'templates/header.php';

$product_id = $_REQUEST['id'];
$sql = "SELECT * FROM products WHERE id='$product_id'";
$query = $pdo->query($sql);

if ($query->rowCount() <= 0) {
  redirect(BASE_URL . 'index.php');
}

$product = $query->fetch(PDO::FETCH_ASSOC);

$product_name = $product['name'];
$product_slug = $product['slug'];
$product_quantity = $product['quantity'];
$product_price = $product['regular_price'];
$product_sale_price = $product['sale_price'];
$product_short_description = $product['short_description'];
$product_description = $product['description'];
$product_sku = $product['sku'];
$product_size = $product['size'];
$product_color = $product['color'];
$product_capacity = $product['capacity'];
$product_weight = $product['weight'];
$product_pocket = $product['pocket'];
$product_water_resistant = $product['water_resistant'];
$product_warranty = $product['warranty'];
$product_total_sales = $product['total_sale'];
$product_img = ADMIN_URL . get_photo($product['featured_photo']);
$product_category = get_product_category($pdo, $product['product_category_id']);


?>



<!-- Page Title-->
<div class="page-title-overlap bg-dark pt-4">
  <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
    <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
          <li class="breadcrumb-item"><a class="text-nowrap" href="<?= BASE_URL ?>"><i class="ci-home"></i>Home</a>
          </li>
          <li class="breadcrumb-item text-nowrap"><a href="<?= BASE_URL . "shop.php" ?>">Shop</a>
          </li>
          <li class="breadcrumb-item text-nowrap active" aria-current="page"><?= $product_name ?></li>
        </ol>
      </nav>
    </div>
    <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
      <h1 class="h3 text-light mb-0"><?= $product_name ?></h1>
    </div>
  </div>
</div>
<div class="container">
  <!-- Gallery + details-->
  <div class="bg-light shadow-lg rounded-3 px-4 py-3 mb-5">
    <div class="px-lg-3">
      <div class="row">
        <!-- Product gallery-->
        <div class="col-lg-7 pe-lg-0 pt-lg-4">
          <div class="product-gallery">
            <div class="product-gallery-preview order-sm-2">
              <!-- featured img -->
              <div class="product-gallery-preview-item active" id="first"><img class="image-zoom"
                  src="<?= $product_img ?>" data-zoom="<?= $product_img ?>" alt="Product image">
                <div class="image-zoom-pane"></div>
              </div>

              <?php

              $sqlForPhotos = "SELECT * FROM product_gallery WHERE product_id='$product_id'";
              $queryForPhotos = $pdo->query($sqlForPhotos);

              if ($queryForPhotos->rowCount() > 0) {
                $photos = $queryForPhotos->fetchAll(PDO::FETCH_ASSOC);
                foreach ($photos as $photo) {
                  $photo_id = $photo['id'];
                  $photo_path = ADMIN_URL . get_photo($photo['photo']);
                  ?>
                  <div class="product-gallery-preview-item" id="photo-<?= $photo_id ?>">
                    <img class="image-zoom" src="<?= $photo_path ?>" data-zoom="<?= $photo_path ?>" alt="Product image">
                    <div class="image-zoom-pane"></div>
                  </div>
                  <?php
                }
              }

              ?>

            </div>
            <div class="product-gallery-thumblist order-sm-1">

              <!-- featured img -->
              <a class="product-gallery-thumblist-item active" href="#first">
                <img src="<?= $product_img ?>" alt="Product thumb">
              </a>

              <?php

              $sqlForPhotos = "SELECT * FROM product_gallery WHERE product_id='$product_id'";
              $queryForPhotos = $pdo->query($sqlForPhotos);

              if ($queryForPhotos->rowCount() > 0) {
                $photos = $queryForPhotos->fetchAll(PDO::FETCH_ASSOC);
                foreach ($photos as $photo) {
                  $photo_id = $photo['id'];
                  $photo_path = ADMIN_URL . get_thumb($photo['photo']);
                  ?>
                  <a class="product-gallery-thumblist-item" href="#photo-<?= $photo_id ?>">
                    <img src="<?= $photo_path ?>" alt="Product thumb">
                  </a>
                  <?php
                }
              }

              ?>


              <!-- <a class="product-gallery-thumblist-item video-item" href="https://www.youtube.com/watch?v=1vrXpMLLK14">
                <div class="product-gallery-thumblist-item-text">
                  <i class="ci-video"></i>Video
                </div>
              </a> -->
            </div>
          </div>
        </div>
        <!-- Product details-->
        <div class="col-lg-5 pt-4 pt-lg-0">
          <div class="product-details ms-auto pb-3">

            <!-- reviews -->
            <!-- <div class="d-flex justify-content-between align-items-center mb-2"><a href="#reviews" data-scroll>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                    class="star-rating-icon ci-star-filled active"></i><i
                    class="star-rating-icon ci-star-filled active"></i><i
                    class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                </div><span class="d-inline-block fs-sm text-body align-middle mt-1 ms-1">74 Reviews</span>
              </a>
              <button class="btn-wishlist me-0 me-lg-n3" type="button" data-bs-toggle="tooltip"
                title="Add to wishlist"><i class="ci-heart"></i></button>
            </div> -->

            <!-- price -->
            <div class="position-relative me-n4">
              <?php
              if ($product_sale_price > 0) {
                ?>
                <div class="mb-3"><span class="h3 fw-normal text-accent me-1">₱<?= $product_sale_price ?></span>
                  <del class="text-muted fs-lg me-3">₱<?= $product_price ?></del><span
                    class="badge bg-danger badge-shadow align-middle mt-n2">Sale</span>
                </div>
              <?php } else { ?>
                <div class="mb-3"><span class="h3 fw-normal text-accent me-1">₱<?= $product_price ?></span>
                </div>
              <?php } ?>

              <?php
              if ($product_quantity > 0) { ?>
                <div class="product-badge product-available mt-n1"><i class="ci-security-check"></i>Product available
                </div>
              <?php } else { ?>
                <div class="product-badge product-unavailable mt-n1"><i class="ci-security-check"></i>Product unavailable
                </div>
              <?php } ?>
            </div>



            <!-- variation -->
            <!-- <div class="fs-sm mb-4"><span class="text-heading fw-medium me-1">Color:</span><span class="text-muted"
                id="colorOption">Red/Dark blue/White</span>
            </div>
            <div class="position-relative me-n4 mb-3">
              <div class="form-check form-option form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="color" id="color1" data-bs-label="colorOption"
                  value="Red/Dark blue/White" checked>
                <label class="form-option-label rounded-circle" for="color1"><span
                    class="form-option-color rounded-circle"
                    style="background-image: url(img/shop/single/color-opt-1.png)"></span></label>
              </div>
              <div class="form-check form-option form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="color" id="color2" data-bs-label="colorOption"
                  value="Beige/White/Dark grey">
                <label class="form-option-label rounded-circle" for="color2"><span
                    class="form-option-color rounded-circle"
                    style="background-image: url(img/shop/single/color-opt-2.png)"></span></label>
              </div>
              <div class="form-check form-option form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="color" id="color3" data-bs-label="colorOption"
                  value="Dark grey/White/Orange">
                <label class="form-option-label rounded-circle" for="color3"><span
                    class="form-option-color rounded-circle"
                    style="background-image: url(img/shop/single/color-opt-3.png)"></span></label>
              </div>

            </div>

            <form class="mb-grid-gutter" method="post">
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center pb-1">
                  <label class="form-label" for="product-size">Size:</label><a class="nav-link-style fs-sm"
                    href="#size-chart" data-bs-toggle="modal"><i class="ci-ruler lead align-middle me-1 mt-n1"></i>Size
                    guide</a>
                </div>
                <select class="form-select" required id="product-size">
                  <option value="">Select size</option>
                  <option value="xs">XS</option>
                  <option value="s">S</option>
                  <option value="m">M</option>
                  <option value="l">L</option>
                  <option value="xl">XL</option>
                </select>
              </div>
              <div class="mb-3 d-flex align-items-center">
                <select class="form-select me-3" style="width: 5rem;">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <button class="btn btn-primary btn-shadow d-block w-100" type="submit"><i
                    class="ci-cart fs-lg me-2"></i>Add to Cart</button>
              </div>
            </form> -->

            <!-- Product panels-->
            <div class="accordion mb-4" id="productPanels">
              <div class="accordion-item">
                <h3 class="accordion-header"><a class="accordion-button" href="#productInfo" role="button"
                    data-bs-toggle="collapse" aria-expanded="true" aria-controls="productInfo"><i
                      class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>Product info</a></h3>
                <div class="accordion-collapse collapse show" id="productInfo" data-bs-parent="#productPanels">
                  <div class="accordion-body">
                    <h6 class="fs-sm mb-2">Composition</h6>
                    <ul class="fs-sm ps-4">
                      <li>Elastic rib: Cotton 95%, Elastane 5%</li>
                      <li>Lining: Cotton 100%</li>
                      <li>Cotton 80%, Polyester 20%</li>
                    </ul>
                    <h6 class="fs-sm mb-2">Art. No.</h6>
                    <ul class="fs-sm ps-4 mb-0">
                      <li>183260098</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h3 class="accordion-header"><a class="accordion-button collapsed" href="#shippingOptions" role="button"
                    data-bs-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions"><i
                      class="ci-delivery text-muted lead align-middle mt-n1 me-2"></i>Shipping options</a></h3>
                <div class="accordion-collapse collapse" id="shippingOptions" data-bs-parent="#productPanels">
                  <div class="accordion-body fs-sm">
                    <div class="d-flex justify-content-between border-bottom pb-2">
                      <div>
                        <div class="fw-semibold text-dark">Courier</div>
                        <div class="fs-sm text-muted">2 - 4 days</div>
                      </div>
                      <div>₱26.50</div>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                      <div>
                        <div class="fw-semibold text-dark">Local shipping</div>
                        <div class="fs-sm text-muted">up to one week</div>
                      </div>
                      <div>₱10.00</div>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                      <div>
                        <div class="fw-semibold text-dark">Flat rate</div>
                        <div class="fs-sm text-muted">5 - 7 days</div>
                      </div>
                      <div>₱33.85</div>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                      <div>
                        <div class="fw-semibold text-dark">UPS ground shipping</div>
                        <div class="fs-sm text-muted">4 - 6 days</div>
                      </div>
                      <div>₱18.00</div>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                      <div>
                        <div class="fw-semibold text-dark">Local pickup from store</div>
                        <div class="fs-sm text-muted">&mdash;</div>
                      </div>
                      <div>₱0.00</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h3 class="accordion-header"><a class="accordion-button collapsed" href="#localStore" role="button"
                    data-bs-toggle="collapse" aria-expanded="true" aria-controls="localStore"><i
                      class="ci-location text-muted fs-lg align-middle mt-n1 me-2"></i>Find in local store</a></h3>
                <div class="accordion-collapse collapse" id="localStore" data-bs-parent="#productPanels">
                  <div class="accordion-body">
                    <select class="form-select">
                      <option value>Select your country</option>
                      <option value="Argentina">Argentina</option>
                      <option value="Belgium">Belgium</option>
                      <option value="France">France</option>
                      <option value="Germany">Germany</option>
                      <option value="Spain">Spain</option>
                      <option value="UK">United Kingdom</option>
                      <option value="USA">USA</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add to cart -->
            <form method="POST" class="mb-4">
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit" name="add_to_cart"> <i
                  class="ci-cart fs-lg me-2"></i>Add to Cart</button>
            </form>

            <!-- Sharing-->
            <!-- <label class="form-label d-inline-block align-middle my-2 me-3">Share:</label><a
              class="btn-share btn-twitter me-2 my-2" href="#"><i class="ci-twitter"></i>Twitter</a><a
              class="btn-share btn-instagram me-2 my-2" href="#"><i class="ci-instagram"></i>Instagram</a><a
              class="btn-share btn-facebook my-2" href="#"><i class="ci-facebook"></i>Facebook</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product description section 1-->
  <div class="row align-items-center py-md-3">
    <div class="col-lg-5 col-md-6 offset-lg-1 order-md-2"><img class="d-block rounded-3"
        src="img/shop/single/prod-img.jpg" alt="Image"></div>
    <div class="col-lg-4 col-md-6 offset-lg-1 py-4 order-md-1">
      <h2 class="h3 mb-4 pb-2">High quality materials</h2>
      <h6 class="fs-base mb-3">Soft cotton blend</h6>
      <p class="fs-sm text-muted pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit.</p>
      <h6 class="fs-base mb-3">Washing instructions</h6>
      <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item"><a class="nav-link active" href="#wash" data-bs-toggle="tab" role="tab"><i
              class="ci-wash fs-xl"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#bleach" data-bs-toggle="tab" role="tab"><i
              class="ci-bleach fs-xl"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#hand-wash" data-bs-toggle="tab" role="tab"><i
              class="ci-hand-wash fs-xl"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#ironing" data-bs-toggle="tab" role="tab"><i
              class="ci-ironing fs-xl"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#dry-clean" data-bs-toggle="tab" role="tab"><i
              class="ci-dry-clean fs-xl"></i></a></li>
      </ul>
      <div class="tab-content text-muted fs-sm">
        <div class="tab-pane fade show active" id="wash" role="tabpanel">30° mild machine washing</div>
        <div class="tab-pane fade" id="bleach" role="tabpanel">Do not use any bleach</div>
        <div class="tab-pane fade" id="hand-wash" role="tabpanel">Hand wash normal (30°)</div>
        <div class="tab-pane fade" id="ironing" role="tabpanel">Low temperature ironing</div>
        <div class="tab-pane fade" id="dry-clean" role="tabpanel">Do not dry clean</div>
      </div>
    </div>
  </div>
  <!-- Product description section 2-->
  <div class="row align-items-center py-4 py-lg-5">
    <div class="col-lg-5 col-md-6 offset-lg-1"><img class="d-block rounded-3" src="img/shop/single/prod-map.png"
        alt="Map"></div>
    <div class="col-lg-4 col-md-6 offset-lg-1 py-4">
      <h2 class="h3 mb-4 pb-2">Where is it made?</h2>
      <h6 class="fs-base mb-3">Apparel Manufacturer, Ltd.</h6>
      <p class="fs-sm text-muted pb-2">​Sam Tower, 6 Road No 32, Dhaka 1875, Bangladesh</p>
      <div class="d-flex mb-2">
        <div class="me-4 pe-2 text-center">
          <h4 class="h2 text-accent mb-1">3258</h4>
          <p>Workers</p>
        </div>
        <div class="me-4 pe-2 text-center">
          <h4 class="h2 text-accent mb-1">43%</h4>
          <p>Female</p>
        </div>
        <div class="text-center">
          <h4 class="h2 text-accent mb-1">57%</h4>
          <p>Male</p>
        </div>
      </div>
      <h6 class="fs-base mb-3">Factory information</h6>
      <p class="fs-sm text-muted pb-md-2">​Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore.</p>
    </div>
  </div>
</div>
<!-- Product carousel (You may also like)-->
<div class="container py-5 my-md-3">
  <h2 class="h3 text-center pb-4">You may also like</h2>
  <div class="tns-carousel tns-controls-static tns-controls-outside">
    <div class="tns-carousel-inner"
      data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: true, &quot;nav&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;768&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;items&quot;:4, &quot;gutter&quot;: 30}}}">
      <!-- Product-->
      <div>
        <div class="card product-card card-static">
          <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
            title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden"
            href="#"><img src="img/shop/catalog/20.jpg" alt="Product"></a>
          <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Men’s Hoodie</a>
            <h3 class="product-title fs-sm"><a href="#">Block-colored Hooded Top</a></h3>
            <div class="d-flex justify-content-between">
              <div class="product-price"><span class="text-accent">$24.<small>99</small></span></div>
              <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Product-->
      <div>
        <div class="card product-card card-static">
          <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
            title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden"
            href="#"><img src="img/shop/catalog/21.jpg" alt="Product"></a>
          <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Men’s Hoodie</a>
            <h3 class="product-title fs-sm"><a href="#">Block-colored Hooded Top</a></h3>
            <div class="d-flex justify-content-between">
              <div class="product-price text-accent">$26.<small>99</small></div>
              <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Product-->
      <div>
        <div class="card product-card card-static">
          <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
            title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden"
            href="#"><img src="img/shop/catalog/22.jpg" alt="Product"></a>
          <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Men’s Hoodie</a>
            <h3 class="product-title fs-sm"><a href="#">Block-colored Hooded Top</a></h3>
            <div class="d-flex justify-content-between">
              <div class="product-price text-accent">$24.<small>99</small></div>
              <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i><i
                  class="star-rating-icon ci-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Product-->
      <div>
        <div class="card product-card card-static">
          <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
            title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden"
            href="#"><img src="img/shop/catalog/23.jpg" alt="Product"></a>
          <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Men’s Hoodie</a>
            <h3 class="product-title fs-sm"><a href="#">Block-colored Hooded Top</a></h3>
            <div class="d-flex justify-content-between">
              <div class="product-price text-accent">$24.<small>99</small></div>
              <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Product-->
      <div>
        <div class="card product-card card-static">
          <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
            title="Add to wishlist"><i class="ci-heart"></i></button><a class="card-img-top d-block overflow-hidden"
            href="#"><img src="img/shop/catalog/24.jpg" alt="Product"></a>
          <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Men’s Hoodie</a>
            <h3 class="product-title fs-sm"><a href="#">Block-colored Hooded Top</a></h3>
            <div class="d-flex justify-content-between">
              <div class="product-price text-accent">$25.<small>00</small></div>
              <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i
                  class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i><i
                  class="star-rating-icon ci-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include './templates/footer.php'; ?>