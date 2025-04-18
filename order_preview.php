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



<main class="container">
        <h1 class="heading">Order Preview</h1>
        <?php include('
        /includes/error_messages.php') ?>

        <hr>
        <div class="order-received-container">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="container order-received-box">


                        <div class="row">
                            <p>Placed On : </p> <span class="order_date"><?= $fetch_orders['placed_on']; ?></span>
                        </div>
                        <div class="row">
                            <p>Name : </p> <span class="cust_name"><?= $fetch_orders['name']; ?></span>
                        </div>
                        <div class="row">
                            <p>Number : </p> <span class="cust_number"><?= $fetch_orders['number']; ?></span>
                        </div>
                        <div class="row">
                            <p>Address : </p> <span class="cust_address"><?= $fetch_orders['address']; ?></span>
                        </div>
                        <div class="row">
                            <p>Total products : </p> <span class="total_products"><?= $fetch_orders['total_products']; ?></span>
                        </div>
                        <div class="row">
                            <p>Total price : </p> <span class="total_price">Rs.<?= $fetch_orders['total_price']; ?>/-</span>
                        </div>
                        <div class="row">
                            <p>Payment method : </p> <span class="payment_method"><?= $fetch_orders['method']; ?></span>
                        </div>
                        <div class="row">
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                                <select name="payment_status" id="order_update" default=" ">
                                    <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                        </div>
                        <div class="row">
                            <div class="order_cart_btn">

                                <input type="submit" value="update" class="submit-btn" name="update_payment">
                                <a href="received_order.php?delete=<?= $fetch_orders['id']; ?>" class="submit-btn" onclick="return confirm('delete this order?');">delete</a>
                                </form>
                            </div>
                        </div>




                    </div>


            <?php
                }
            } else {
                echo '<p class="empty">no orders placed yet!</p>';
            }
            ?>

        </div>
    </main>



    <!-- footer php -->
    <?php
    include("includes/footer.php")
    ?>

    <!-- script of cart.js -->
    <script src="js/cart.js"></script>
    <!-- End of script of cart.js -->

</body>

</html>