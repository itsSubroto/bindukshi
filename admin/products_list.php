<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}



// product delete
if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
    unlink('../uploaded_img/' . $fetch_delete_image['image_02']);
    unlink('../uploaded_img/' . $fetch_delete_image['image_03']);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    // $delete_cart->execute([$delete_id]);
    // $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    // $delete_wishlist->execute([$delete_id]);
    header('location:products_list.php');
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
        <!-- <div class="container">
            <h2>Products List</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum, blanditiis adipisci, tempora vitae rem atque minus perferendis a voluptatibus minima eius qui voluptatem voluptates fugit nesciunt quasi distinctio maiores sequi.</p>
        </div> -->

        <section class="show-products container">

            <h1 class="heading">Products Added.</h1>
            <hr>
            <div class="box-container product-container">

                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <div class="box product-each">
                            <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="" class="product-img">
                            <hr>
                            <div class="product-each-lower">
                                <div class="name"><?= $fetch_products['name']; ?></div>
                                <div class="price">Rs.<span><?= $fetch_products['price']; ?></span>/-</div>
                                <div class="details"><span><?= $fetch_products['details']; ?></span></div>
                                <div class="flex-btn">
                                    <a href="products_edit.php?update=<?= $fetch_products['id']; ?>" class="option-btn btn">update</a>
                                    <a href="products_list.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn btn" onclick="return confirm('delete this product?');">delete</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">no products added yet!</p>';
                }
                ?>






            </div>

        </section>


    </main>
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>