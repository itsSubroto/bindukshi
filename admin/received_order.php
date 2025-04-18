<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    //    $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
    $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_payment->execute([$payment_status, $order_id]);
    $message[] = 'payment status updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:received_order.php');
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include('../includes/admin_sidebar.php') ?>
    <main class="container">
        <h1 class="heading">Products Orders.</h1>
        <?php include('../includes/error_messages.php') ?>

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
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>