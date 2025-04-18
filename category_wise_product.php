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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">


</head>

<body>

    <?php include 'includes/header.php'; ?>
    <?php include 'includes/error_messages.php'; ?>


    <section class="products">

        <div class="category-header">
            <p><?= $category = $_GET['category']; ?> </p>
        </div>
        <div class="line">
            <hr>
            <i class="fa-solid fa-infinity"></i>
            <hr>
        </div>

        <section>
            <div class="product-container">

                <?php
                $category = $_GET['category'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE categories LIKE '%{$category}%'");
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <div class="each_product_container ">

                            <form action="" method="post" class="box">
                                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                                <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                                <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">


                                <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">


                                <button class="wish" type="submit" name="add_to_wishlist"><i class="fa-regular fa-heart"></i></button>

                                <a href="productDetail.php?pid=<?= $fetch_product['id']; ?>&category=<?= $category ?>">
                                    <div class=" product_img">
                                        <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">

                                    </div>
                                </a>

                                <hr>

                                <div class="name"><?= $fetch_product['name']; ?></div>

                                <div class="price_section">
                                    <div class="price">Rs. <?= $fetch_product['price']; ?>/-</div>
                                    <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                                </div>
                                <input type="submit" value="add to cart" class="category_section_btn" name="add_to_cart">
                            </form>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">no products found!</p>';
                }
                ?>

            </div>

        </section>













        <?php include 'includes/footer.php'; ?>



</body>

</html>