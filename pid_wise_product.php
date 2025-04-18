<?php

include 'includes/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

include 'includes/wishlist_cart.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bindukshi Jewellers</title>
    <link rel="stylesheet" href="../projectAgain/css/style.css">
</head>

<body>
    <!-- header php -->
    <?php
    include("includes/header.php")
    ?>

    <?php
    include("includes/error_messages.php")
    ?>
    <!-- getting the values from the database -->
    <?php
    $pid = $_GET['pid'];
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $select_products->execute([$pid]);
    if ($select_products->rowCount() > 0) {
        while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">


                <!-- main content of the page starts from here -->

                <div class="container product">
                    <div class="product-top">
                        <div class="hero product-hero">
                            <div class="image-preview">
                                <div class="preview-slider">
                                    <!-- this section come from js "button" -->
                                    <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" class="preview-image">
                                    <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="" class="preview-image">
                                    <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="" class="preview-image">
                                    <!-- <img src="images/hero-img-4.jpg" alt="" class="preview-image">
                        <img src="images/hero-img-5.jpg" alt="" class="preview-image"> -->
                                </div>
                            </div><!--End of bottom -->
                            <div class="top product-top">

                                <div class="frame product-frame">
                                    <div class="slider product-slider">
                                        <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="" class="image product-image">
                                    </div> <!--End of slide -->
                                </div><!--End of frame -->

                            </div><!--End of top -->
                        </div><!--End of product hero -->
                        <div class="wishlist-share-btn">
                            <form action="" method="post">
                                <button class="wish" type="submit" name="add_to_wishlist">
                                    <!-- <?php
                                            if (isset($message)) {
                                                foreach ($message as $message) {
                                                    if ($message == 'already added to wishlist!') {
                                                        echo '<i class="fa-solid fa-heart"></i>';
                                                    } else {
                                                        echo '<i class="fa-regular fa-heart"></i>';
                                                    }
                                                }
                                            } else {
                                                echo '<i class="fa-regular fa-heart"></i>';
                                            }
                                            ?> -->

                                </button>


                                <!-- <i class="fa-regular fa-heart"></i>
                    <i class="fa-solid fa-share-nodes"></i> -->
                            </form>
                        </div><!--End of wishlist and share button -->
                        <div class="product-details">
                            <h2><?= $fetch_product['name']; ?> </h2>
                            <hr>
                            <p class="product-detail-desc"><?= $fetch_product['details']; ?></p>
                            <div class="price">
                                Offer price
                                <!-- <div class="mrp"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    <p>32795</p>
                                </div> -->
                                <div class="offer-price"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    <p><?= $fetch_product['price']; ?></p>
                                </div>
                            </div>
                            <p>**Price include all taxes.</p>
                            <div class="weight-quantity">
                                <div class="weight">
                                    <p>Gross Weight</p>
                                    <select name="available-weight" class="weight-dropdown">
                                        <option value="<?= $fetch_product['weight']; ?>"><?= $fetch_product['weight']; ?></option>
                                    </select>
                                    <!-- <p>Gold purity : <?= $fetch_product['purity']; ?></p> -->
                                </div><!--End of gross weight -->
                                <div class="quantity-box">
                                    <p>Qty</p>




                                    <input type="number" name="qty" class="qty quantity-toggle" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">

                                </div>
                            </div>
                        </div><!--End of product details -->
                    </div>
                    <div class="product-mid">
                        <div class="more-product-details">
                            <?= $fetch_product['details']; ?>
                        </div>
                        <div class="separator">

                        </div>
                        <div class="right-part">
                            <div class="cart-btn-div">
                                <input type="submit" value="Add to cart" class="cart-buy btn" name="add_to_cart">

                                <div class="cart-buy btn">Buy Now</div>
                            </div>
                            <hr>
                            <div class="country-pincode">
                                <input type="text" name="country" placeholder="Country" class="country input">
                                <input type="text" name="pincode" placeholder="Enter Pincode" class="pincode input">
                            </div>
                            <hr>
                            <div class="purity-delivery-freeshipping-div">

                                <div class="part">
                                    <img src="images/bsi-hallmark-logo.png" alt="" class="bsi-img">
                                    Purity Guaranteed
                                </div>
                                <div class="part">
                                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                    Exchange across all stores
                                </div>
                                <div class="part">
                                    <i class="fa-solid fa-truck-fast"></i>
                                    Free shipping across India
                                </div>
                            </div>
                        </div>

                    </div><!--End of product mid part -->
                    <div class="line">
                        <hr>
                        <i class="fa-solid fa-infinity"></i>
                        <hr>
                    </div><!--end of infinite line-->
                    <div class="price-breakdown-div">
                        <h2>Price Breakdown</h2>
                        <table class="price-breakdown-table">
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Gold Rate</th>
                                    <th>Weight</th>
                                    <th>Discount</th>
                                    <th>Final Value</th>
                                </tr>
                            </thead>
                            <hr>
                            <tbody>
                                <tr>
                                    <td class="component">Earring</td>
                                    <td class="gold-rate">80000</td>
                                    <td class="weight"><?= $fetch_product['weight']; ?>gm</td>
                                    <td class="discount">1000</td>
                                    <td class="final-value"><?= $fetch_product['price']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!--end of price break down-->
                    <div class="line">
                        <hr>
                        <i class="fa-solid fa-infinity"></i>
                        <hr>
                    </div><!--end of infinite line-->

                    <!-- <div class="similar-products">
                        <h2>similar Products</h2>

                        <div class="similar-product-whole-container">
                            <div class="product-toggle-arrow left">
                                <i class="fa-solid fa-less-than"></i>
                            </div>
                            <div class="similar-product-frame">
                                <div class="similar-product-container ">
                                    <?php
                                    $category = $_GET['category'];
                                    $pid = $_GET['pid'];
                                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE categories LIKE '%{$category}%'");
                                    $select_products->execute();
                                    if ($select_products->rowCount() > 0) {
                                        while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <a href="productDetail.php?pid=<?= $fetch_product['id']; ?>&&category=<?= $category ?>">
                                                <form action="" method="post" class="box">
                                                    <div class="product-box ">
                                                        <div class="similar-product-img"><img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt=""></div>

                                                        <div class="similar-product-wishbtn">
                                                            <i class="fa-regular fa-heart"></i>
                                                        </div>
                                                        <div class="similar-product-title">
                                                            <?= $fetch_product['name']; ?> | <?= $fetch_product['details']; ?> |
                                                        </div>
                                                        <div class="similar-product-price">
                                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                                            <?= $fetch_product['price']; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </a>
                                    <?php
                                        }
                                    } else {
                                        echo '<p class="empty">no products found!</p>';
                                    }
                                    ?>


                                </div>
                            </div>
                            <div class="product-toggle-arrow right">
                                <i class="fa-solid fa-greater-than"></i>
                            </div>
                        </div>
                    </div> -->
                    <!-- end of similar products -->

                </div>



            </form>


    <?php
        }
    } else {
        echo '<p class="empty">no products added yet!</p>';
    }
    ?>






    <!-- footer php -->
    <?php
    include("includes/footer.php")
    ?>

    <!-- script of cart.js -->
    <script src="js/productDetail.js"></script>
    <!-- End of script of cart.js -->

</body>

</html>