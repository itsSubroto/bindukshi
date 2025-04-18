<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
} 

// Fetch admin details
$fetch_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
$fetch_admin->execute([$admin_id]);
$fetch_profile = $fetch_admin->fetch(PDO::FETCH_ASSOC);

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
    <main>
        <div class="dashboard_body">
            <div class="container dashboard_container">
                <h2>Welcome!</h2>
                <p><?= $fetch_profile['name']; ?></p>
                <div>
                    <a href="update_profile.php" class="submit-btn">Update Profile</a>
                </div>
            </div>
            <div class="container dashboard_container">
                <?php
                $total_pendings = 0;
                $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_pendings->execute(['pending']);
                if ($select_pendings->rowCount() > 0) {
                    while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                        $total_pendings += $fetch_pendings['total_price'];
                    }
                }
                ?>
                <h2><span>Rs.</span><?= $total_pendings; ?><span>/-</span></h2>
                <p>Total Pending</p>
                <div>
                    <a href="received_order.php" class="submit-btn">See Orders</a>
                </div>
            </div>
            <div class="container dashboard_container">
                <?php
                $total_completes = 0;
                $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_completes->execute(['completed']);
                if ($select_completes->rowCount() > 0) {
                    while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                        $total_completes += $fetch_completes['total_price'];
                    }
                }
                ?>
                <h2><span>Rs.</span><?= $total_completes; ?><span>/-</span></h2>
                <p>Completed Orders</p>
                <div>
                    <a href="received_order.php" class="submit-btn">See Orders</a>
                </div>
            </div>
            <div class="container dashboard_container">
                <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                $number_of_orders = $select_orders->rowCount()
                ?>
                <h2><?= $number_of_orders; ?></h2>
                <p>Orders Placed</p>
                <div>
                    <a href="received_order.php" class="submit-btn">See Orders</a>
                </div>
            </div>
            <div class="container dashboard_container">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                $number_of_products = $select_products->rowCount()
                ?>
                <h2><?= $number_of_products; ?></h2>
                <p>Products Added</p>
                <div>
                    <a href="products_list.php" class="submit-btn">See Products</a>
                </div>
            </div>
            <div class="container dashboard_container">
                <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();
                $number_of_users = $select_users->rowCount()
                ?>
                <h2><?= $number_of_users; ?></h2>
                <p>Normal Users</p>
                <div>
                    <a href="user_accounts.php" class="submit-btn">See Users</a>
                </div>
            </div>
            <div class="container dashboard_container">
                <?php
                $select_admins = $conn->prepare("SELECT * FROM `admins`");
                $select_admins->execute();
                $number_of_admins = $select_admins->rowCount()
                ?>
                <h2><?= $number_of_admins; ?></h2>
                <p>Admin Users</p>
                <div>
                    <a href="admin_accounts.php" class="submit-btn">See Admins</a>

                </div>
            </div>
            <div class="container dashboard_container">
                <?php
                // $select_messages = $conn->prepare("SELECT * FROM `messages`");
                // $select_messages->execute();
                // $number_of_messages = $select_messages->rowCount()
                ?>
                <h2>0</h2>
                <p>New Messages</p>
                <div>
                    <a href="messages.php" class="submit-btn">See Messages</a>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>