<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
    $delete_admins->execute([$delete_id]);
    $message[] = 'Admin removed';

    header('location:admin_accounts.php');
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Accounts</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include('../includes/admin_sidebar.php') ?>
    <!--  -->


    <!--  -->
    <main>
        <div class="container accounts">


            <h1 class="heading">Admin Accounts</h1>
            <?php include('../includes/error_messages.php') ?>

            <hr>
            <div class="box-container  product-container">

                <div class="box admin-container">
                    <p>Add New Admin</p>
                    <a href="register_admin.php" class="option-btn btn">Register Admin</a>
                </div>

                <?php
                $select_accounts = $conn->prepare("SELECT * FROM `admins`");
                $select_accounts->execute();
                if ($select_accounts->rowCount() > 0) {
                    while ($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <div class="box admin-container">
                            <p> Admin Id : <span><?= $fetch_accounts['id']; ?></span> </p>
                            <p> Admin name : <span><?= $fetch_accounts['name']; ?></span> </p>
                            <div class="flex-btn">
                                <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account?')" class="delete-btn btn">delete</a>
                                <?php
                                if ($fetch_accounts['id'] == $admin_id) {
                                    echo '<a href="update_profile.php" class="option-btn btn">update</a>';
                                }
                                ?>
                            </div>
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

    <!--  -->
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>