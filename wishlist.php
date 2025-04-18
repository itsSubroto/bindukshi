<?php

include 'includes/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
};

include 'includes/wishlist_cart.php';

// delete each item of wishlist
if (isset($_POST['delete'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
    $delete_wishlist_item->execute([$wishlist_id]);
    $message[] = "Removed from Wishlist";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bindukshi Jewellers | Wishlist</title>
    <link rel="stylesheet" href="../projectAgain/css/style.css">
</head>

<body>
    <!-- header php -->
    <?php
    include("includes/header.php")
    ?>
    <?php include 'includes/error_messages.php'; ?>


    <div class="">
        <div class="wishlist">
            <?php
            $grand_total = 0;
            $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $select_wishlist->execute([$user_id]);
            if ($select_wishlist->rowCount() > 0) {
                while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
                    // $grand_total += $fetch_wishlist['price'];
            ?>

                    <form action="" method="post" class="box">
                        <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
                        <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">

                        <!-- content start -->
                        <div class="wishlist-box">
                            <a href="productDetail.php?pid=<?= $fetch_wishlist['pid']; ?>" class="">
                                <div class="product-img">
                                    <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
                                </div>

                                <div class="product-desc">
                                    <div class="product-title">
                                        <p><?= $fetch_wishlist['name']; ?></p>
                                    </div>

                                    <div class="product-price">
                                        <i class="fa-solid fa-indian-rupee-sign"><?= $fetch_wishlist['price']; ?></i>
                                    </div>
                            </a>
                            <div class="btns">
                                <input type="submit" value="Add to Cart" class="add-to-cart-btn cart-btn" name="add_to_cart">

                                <input type="submit" value="delete item" onclick="return confirm('delete this from wishlist?');" class="add-to-cart-btn remove-btn" name="delete">

                                <input type="number" name="qty" class="cart-btn" min="1" max="99" value="1">

                            </div>
                        </div>
                    </form>
        </div>



<?php
                }
            } else {
                echo '<p class="empty">your wishlist is empty</p>';
            }
?>

    </div>




    <!-- footer php -->
    <?php
    include("includes/footer.php")
    ?>

</body>

</html>