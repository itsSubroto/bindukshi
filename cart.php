<?php

include 'includes/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
};

// include 'includes/wishlist_cart.php';

if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
    $message[] = 'cart item deleted!!!';
}

if (isset($_GET['delete_all'])) {
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:cart.php');
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $qty = strip_tags($qty);
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message[] = 'cart quantity updated';
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bindukshi Jewellers | Cart</title>
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
    <div class="container">
        <!-- start wishlist -->
        <div class="wishlist">
            <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            // $select_products = $conn->prepare("SELECT * FROM `product` WHERE user_id = ?");
            // $select_products = $conn->prepare("SELECT * FROM `products` WHERE categories LIKE '%{$category}%'");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            ?>


                    <form action="" method="post" class="box">
                        <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">

                        <div class="wishlist-box">
                            <a href="pid_wise_product.php?pid=<?= $fetch_cart['pid']; ?> ?>" class="">
                                <div class="product-img">
                                    <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                                </div>
                                <div class="product-desc">
                                    <div class="product-title">
                                        <a href=""><?= $fetch_cart['name']; ?></a>
                                    </div>

                                    <!-- <div class="weight-size">
                                        <div class="weight">Weight : <?= $fetch_cart['weight']; ?></div>
                                        <div class="devider">|</div>

                                        <div class="size">size : 18.80mm</div>
                                    </div> -->
                                    <div class="product-price">
                                        <i class="fa-solid fa-indian-rupee-sign"><?= $fetch_cart['price']; ?></i>
                                    </div>
                            </a>
                            <div class="btns">

                                <input type="submit" value="Remove item" onclick="return confirm('delete this from cart?');" class="delete-btn add-to-cart-btn remove-btn" name="delete">


                                <!-- <div class="add-to-cart-btn remove-btn">Remove<i class="fa-solid fa-trash"></i></div> -->

                                <!-- <div class="devider">|</div> -->

                                <!-- <div class="add-to-wishlist-btn remove-btn">
                                    <i class="fa-solid fa-heart"></i>
                                    <div class="Move-to-wishlist ">Move To Wishlist</div>


                                </div> -->

                                <div class="add-to-wishlist-btn remove-btn">

                                    <input type="number" name="qty" class="cart_qty qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                                    <button type="submit" class="fa-solid fa-pen-to-square cart_save_btn" name="update_qty"></button>

                                </div>
                            </div>
                            <div class="btns">
                                <div class="sub-total remove-btn"> Sub Total : <span><i class="fa-solid fa-indian-rupee-sign"></i><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
                            </div>
                        </div>
        </div>
        </form>
        </a>
<?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">your cart is empty</p>';
            }
?>




    </div><!-- end of wishlist -->

    <div class="order-summery-container">
        <div class="blank"></div>
        <div class="order-summery">
            <div class="head">
                <h2>Order Summery</h2>
                <hr class="under-head">
            </div><!-- end of order head -->
            <div class="mid">
                <div class="sub-total align-text">
                    <p>Sub Total</p>
                    <i class="fa-solid fa-indian-rupee-sign"> <?= $grand_total; ?></i>
                </div>
                <div class="discount align-text">
                    <p>Discount</p>
                    <i class="fa-solid fa-indian-rupee-sign">
                        <?php $discount = $grand_total * (10 / 100);
                        echo $discount; ?></i>
                    <!-- giving 10% discount means we are taking 90% of the total amount -->
                </div>
                <div class="delivery_charges  align-text">
                    <p>Delivery Charge</p>
                    <p> <span style="text-decoration: line-through;">40 </span>&puncsp;FREE</p>
                </div>
            </div><!-- end of order mid -->
            <div class="down">
                <hr class="under-head">
                <div class="total align-text">
                    <p>Total (inc Taxes)</p>
                    <i class="fa-solid fa-indian-rupee-sign"> <?= $grand_total - $discount ?></i>
                </div>
                <div class="save align-text">
                    <p>Save</p>
                    <i class="fa-solid fa-indian-rupee-sign"> <?= $discount + 40; ?></i>
                </div>
                <div class="order-btn">
                    <div class="blank">
                    </div>
                    <div class="proceed-to-buy btn">
                        <a href="confirmOrder.php" class=" <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Buy.</a>

                    </div>

                </div><!-- end of order down -->
            </div><!-- end of order down -->

        </div><!-- end of order summery -->
    </div><!-- end of order summery container -->

    </div>


    <!-- footer php -->
    <?php
    include("includes/footer.php")
    ?>

    <!-- script of cart.js -->
    <script src="js/cart.js"></script>
    <!-- End of script of cart.js -->

</body>

</html>