<?php
include 'includes/connect.php';


session_start();
$user_id;

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
    <!-- <link rel="stylesheet" href="../projectAgain/css/style.css"> -->
</head>

<body>
    <?php
    include('includes/header.php')
    ?>
    <div class="hero">
        <div class="top">
            <div class="arrow left">
                <i class="fa-solid fa-less-than"></i>
            </div>
            <div class="frame">
                <div class="slider">
                    <img src="images/banner1.jpg" alt="" class="image">
                    <img src="images/tanisq_banner1.webp" alt="" class="image">
                    <img src="images/tanisq_banner2.webp" alt="" class="image">
                    <img src="images/tanisq_banner3.webp" alt="" class="image">


                </div> <!--End of slide -->
            </div><!--End of frame -->
            <div class="arrow right">
                <i class="fa-solid fa-greater-than"></i>
            </div>
        </div><!--End of top -->
        <div class="bottom">
            <!-- this section come from js "button" -->
        </div><!--End of bottom -->
    </div><!--End of hero -->
    <!-- <hr> -->
    <section class="category container">
        <div class="category-header">
            <h2>Shope By Category</h2>
            <p>browse through your favorites. we have get them all</p>
        </div>
        <div class="line">
            <hr>
            <i class="fa-solid fa-infinity"></i>
            <hr>
        </div>
        <div class="category-products">
            <?php
            $select_category = $conn->prepare("SELECT * FROM `category`");
            $select_category->execute();
            if ($select_category->rowCount() > 0) {
                while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="category-products-box">
                        <a href="category_wise_product.php?category=<?= $fetch_category['name']; ?>">
                            <div class="box-img"><img src="uploaded_img/<?= $fetch_category['img']; ?>" alt="<?= $fetch_category['img']; ?>"></div>
                            <hr>
                            <div class="category-name"><?= $fetch_category['name']; ?></div>
                            <div class="explore-btn">Explore ></div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no category added yet!</p>';
            }
            ?>



        </div>
    </section><!--end of category section-->
    <section class="category-gender container">
        <div class="category-header">
            <h2>Shope By Gender</h2>
            <p>First-Class jewellery for first-class Men, Women & Children</p>
        </div>
        <div class="line">
            <hr>
            <i class="fa-solid fa-infinity"></i>
            <hr>
        </div>
        <div class="category-gender-products">
            <div class="category-gender-products-box">
                <a href="gender_wish_product.php?gender=men">
                    <div class="box-img gender-img"><img src="images/category-gender-men.webp" alt=""></div>
                    <hr>
                    <div class="box-bottom">
                        <div class="category-name">
                            <h2>Men</h2>
                        </div>
                        <div class="explore-btn">
                            <p>Explore</p>>
                        </div>
                    </div>

                </a>
            </div>
            <div class="category-gender-products-box">
                <a href="gender_wish_product.php?gender=kids">
                    <div class="box-img gender-img"><img src="images/category-gender-kid.jpg" alt=""></div>
                    <hr>
                    <div class="box-bottom">
                        <div class="category-name">
                            <h2>Kids</h2>
                        </div>
                        <div class="explore-btn">
                            <p>Explore</p>>
                        </div>
                    </div>

                </a>
            </div>
            <div class="category-gender-products-box">
                <a href="gender_wish_product.php?gender=women">
                    <div class="box-img gender-img"><img src="images/category-gender-women.webp" alt=""></div>
                    <hr>
                    <div class="box-bottom">
                        <div class="category-name">
                            <h2>Women</h2>
                        </div>
                        <div class="explore-btn">
                            <p>Explore</p>>
                        </div>
                    </div>

                </a>
            </div>
        </div>
    </section><!--end of gender category section-->
    <div class="line">
        <hr>
        <i class="fa-solid fa-infinity"></i>
        <hr>
    </div><!--end of infinite line-->
    <!-- <section>sd</section>
    <section>dew</section> -->
    <?php
    include("includes/footer.php")
    ?>

    <!-- script of cart.js -->
    <!-- <script src="js/cart.js"></script> -->
    <!-- End of script of cart.js -->
    <script src="js/home.js"></script>
</body>

</html>