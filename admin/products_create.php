<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {

    $name = $_POST['name'];
    $categories = $_POST['product-categories'];
    $weight = $_POST['product-weight'];
    $gender = $_POST['product-gender-categories'];
    $tag = $_POST['product-tag-number'];
    $stock = $_POST['product-stock'];
    //    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    //    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    //    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    //    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;

    $image_02 = $_FILES['image_02']['name'];
    //    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = '../uploaded_img/' . $image_02;

    $image_03 = $_FILES['image_03']['name'];
    //    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = '../uploaded_img/' . $image_03;

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'product name already exist!';
    } else {

        $insert_products = $conn->prepare("INSERT INTO `products`(name,categories,weight,gender,tag,stock,price,details, image_01, image_02, image_03) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $insert_products->execute([$name, $categories, $weight, $gender, $tag, $stock, $price, $details, $image_01, $image_02, $image_03]);


        if ($insert_products) {
            if ($image_size_01 > 2000000 or $image_size_02 > 2000000 or $image_size_03 > 2000000) {
                $message[] = 'image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name_01, $image_folder_01);
                move_uploaded_file($image_tmp_name_02, $image_folder_02);
                move_uploaded_file($image_tmp_name_03, $image_folder_03);
                $message[] = 'New Product Added!';
            }
        }
    }
};

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
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    header('location:products.php');
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
        <div class="container product-create">
            <h2>Add Products</h2>
            <?php include('../includes/error_messages.php') ?>

            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-3">
                    <div class="row">
                        <p>Product Name</p>
                        <input type="text" class="box" required name="name" placeholder="Fancy Anklets with Radium">
                    </div>
                    <div class="row">
                        <p>Product Categories</p>
                        <select name="product-categories" id="product-categories" required>
                            <option value="mangalsutra">mangalsutra</option>
                            <option value="gold-coin">gold coin</option>
                            <option value="earring">earring</option>
                            <option value="ring">ring</option>
                            <option value="pendent">pendent</option>
                            <option value="nose-ring">nose ring</option>
                            <option value="neckless">neckless</option>
                            <option value="bangle">bangle</option>
                            <option value="bracelet">bracelet</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <p>Weight</p>
                        <input type="text" name="product-weight" placeholder="30gm" required>
                    </div>
                    <div class="row">
                        <p>Gender</p>
                        <select name="product-gender-categories" id="product-gender-categories" required>
                            <option value="women">women</option>
                            <option value="men">men</option>
                            <option value="kids">kids</option>
                            <option value="kids">men and women both</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <p>Description</p>

                    <textarea name="details" placeholder="Add Product Description" class="box" required maxlength="500" cols="30" rows="10"></textarea>
                </div>
                <div class="col-2">
                    <div class="row">
                        <p>Tag Number</p>
                        <input type="text" name="product-tag-number" placeholder="Enter Product tag number">
                    </div>
                    <div class="row">
                        <p>Stock</p>
                        <input type="text" name="product-stock" placeholder="Enter product stock available" required>
                    </div>
                </div>


                <div class="row">
                    <h2>Pricing Details</h2>
                </div>
                <hr>

                <div class="col-3">
                    <div class="row">
                        <p>Price</p>
                        <input type="number" name="price" placeholder="Enter product price" min="0" class="box" required max="9999999999" onkeypress="if(this.value.length == 10) return false;">

                    </div>
                    <!-- <div class="row">
                        <p>Discount</p>
                        <input type="text" name="product-discount" placeholder="Enter discount in percentage (%)">
                    </div>
                    <div class="row">
                        <p>Tax</p>
                        <input type="text" name="product-tax" placeholder="Enter tax in percentage(%)">
                    </div> -->
                </div>
                <h2>Images</h2>
                <hr>

                <div class="col-2">

                    <div class="row">
                        <span>Image 01 (required)</span>
                        <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
                    </div>
                    <div class="row">
                        <span>Image 02 (required)</span>
                        <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
                    </div>
                    <div class="row">
                        <span>Image 03 (required)</span>
                        <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
                    </div>

                </div>
                <hr>
                <div class="col-2">
                    <div class="row">

                        <input type="submit" value="Add Product" class="btn" name="add_product">
                    </div>
                    <div class="row">
                        <input class="submit-btn" type="reset" name="product-reset" value="Reset">
                    </div>
                </div>
            </form>

        </div>

    </main>
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>