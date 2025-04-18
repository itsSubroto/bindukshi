<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_user->execute([$delete_id]);
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_orders->execute([$delete_id]);
    $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
    // $delete_messages->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    // $delete_cart->execute([$delete_id]);
    // $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
    // $delete_wishlist->execute([$delete_id]);
    $message[] = 'User deleted';

    header('location:user_accounts.php');
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
    <main>
        <div class="container ">

            <h1 class="heading">User accounts</h1>
            <?php include('../includes/error_messages.php') ?>

            <hr>
            <div class="box-container  product-container">

                <?php
                $select_accounts = $conn->prepare("SELECT * FROM `users`");
                $select_accounts->execute();
                if ($select_accounts->rowCount() > 0) {
                    while ($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <div class="box admin-container">
                            <p> User id : <span><?= $fetch_accounts['id']; ?></span> </p>
                            <p> Username : <span><?= $fetch_accounts['name']; ?></span> </p>
                            <p> Email : <span><?= $fetch_accounts['email']; ?></span> </p>
                            <a href="user_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account? the user related information will also be delete!')" class="delete-btn btn">delete</a>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">no accounts available!</p>';
                }
                ?>

            </div>
        </div>

    </main>
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>