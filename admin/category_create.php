<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};


// Fetch admin details
$fetch_admin = $conn->prepare("SELECT * FROM `category` WHERE id = ?");
$fetch_admin->execute([$admin_id]);
$fetch_profile = $fetch_admin->fetch(PDO::FETCH_ASSOC);
// ===========================

if (isset($_POST['add_product'])) {

    $name = ucwords($_POST['name']);

    $image_01 = $_FILES['image_01']['name'];
    //    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;



    $select_products = $conn->prepare("SELECT * FROM `category` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'product name already exist!';
    } else {

        $insert_products = $conn->prepare("INSERT INTO `category`(name, img) VALUES(?,?)");
        $insert_products->execute([$name, $image_01]);


        if ($insert_products) {
            if ($image_size_01 > 2000000) {
                $message[] = 'image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name_01, $image_folder_01);
                $message[] = 'New Product Added!';
            }
        }
    }
};


if (isset($_GET['delete'])) {



    $delete_category = $_GET['delete'];
    $delete_admins = $conn->prepare("DELETE FROM `category` WHERE id = ?");
    $delete_admins->execute([$delete_category]);
    $message[] = 'Category removed';




    header('location:category_create.php');
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
        <div class="container">
            <h2>Category Create</h2>
            <?php include('../includes/error_messages.php') ?>

            <div class="container">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <p>Product Name</p>
                        <input type="text" class="box input" required name="name" placeholder="Enter Category">
                    </div>

                    <div class="row">
                        <p>Image 01 (required)</p>
                        <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box input" required>
                    </div>

                    <div class="col-2">
                        <div class="row">
                            <input type="submit" value="Add Category" class="btn input" name="add_product">
                        </div>
                        <div class="row">
                            <input class="btn input" type="reset" name="product-reset" value="Reset">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Available categories  -->

            <div class="container category">

                <div class="col-2">
                    <div class="row container">
                        <h2>Available Categories</h2>
                        <hr>
                        <?php
                        $select_category = $conn->prepare("SELECT * FROM `category`");
                        $select_category->execute();
                        if ($select_category->rowCount() > 0) {
                            while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                <div class="each-category-box">
                                    <p><?= $fetch_category['name']; ?></p>
                                    <a href="category_create.php?delete=<?= $fetch_category['id']; ?>" onclick="return confirm('delete this account?')"><i class="fa-solid fa-xmark" alt="delete"></i></a>

                                </div>

                        <?php
                            }
                        } else {
                            echo '<p class="empty">no products added yet!</p>';
                        }
                        ?>


                    </div>
                    <div class="row"></div>
                </div>

            </div>
        </div>

    </main>
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>