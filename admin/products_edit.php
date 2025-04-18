<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['update'])) {

    $pid = $_POST['pid'];
    $name = $_POST['name'];


    $categories = $_POST['product-categories'];
    $weight = $_POST['product-weight'];
    $gender = $_POST['product-gender-categories'];
    $tag = $_POST['product-tag-number'];
    $stock = $_POST['product-stock'];




    // $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    // $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    // $details = filter_var($details, FILTER_SANITIZE_STRING);

    $update_product = $conn->prepare("UPDATE `products` SET name = ?,categories=?,weight=?,gender=?,tag=?,stock=?, price = ?, details = ? WHERE id = ?");
    $update_product->execute([$name, $categories, $weight, $gender, $tag, $stock, $price, $details, $pid]);

    $message[] = 'product updated successfully!';

    $old_image_01 = $_POST['old_image_01'];
    $image_01 = $_FILES['image_01']['name'];
    // $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;

    if (!empty($image_01)) {
        if ($image_size_01 > 2000000) {
            $message[] = 'image size is too large!';
        } else {
            $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
            $update_image_01->execute([$image_01, $pid]);
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            unlink('../uploaded_img/' . $old_image_01);
            $message[] = 'image 01 updated successfully!';
        }
    }

    $old_image_02 = $_POST['old_image_02'];
    $image_02 = $_FILES['image_02']['name'];
    // $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = '../uploaded_img/' . $image_02;

    if (!empty($image_02)) {
        if ($image_size_02 > 2000000) {
            $message[] = 'image size is too large!';
        } else {
            $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
            $update_image_02->execute([$image_02, $pid]);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            unlink('../uploaded_img/' . $old_image_02);
            $message[] = 'image 02 updated successfully!';
        }
    }

    $old_image_03 = $_POST['old_image_03'];
    $image_03 = $_FILES['image_03']['name'];
    // $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = '../uploaded_img/' . $image_03;

    if (!empty($image_03)) {
        if ($image_size_03 > 2000000) {
            $message[] = 'image size is too large!';
        } else {
            $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
            $update_image_03->execute([$image_03, $pid]);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            unlink('../uploaded_img/' . $old_image_03);
            $message[] = 'image 03 updated successfully!';
        }
    }
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
            <h2>Update Products</h2>
            <?php include('../includes/error_messages.php') ?>

            <hr>
            <?php
            $update_id = $_GET['update'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$update_id]);
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- fetch product id and images -->
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                        <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
                        <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
                        <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">

                        <!-- show images -->
                        <div class="image-container">
                            <div class="main-image">
                                <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="" class="main-image-img">
                            </div>
                            <div class="sub-image">
                                <img class="each-sub-image" src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                                <img class="each-sub-image" src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
                                <img class="each-sub-image" src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">
                            </div>
                        </div>

                        <span>Update Name</span>


                        <div class="col-3">
                            <div class="row">
                                <p>Update Product Name</p>
                                <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['name']; ?>">
                            </div>

                            <div class="row">
                                <p>Update Product Categories</p>
                                <!-- <select name="product-categories" id="product-categories" 
                                default="<?= $fetch_products['categories']; ?>" required>
                                    <option value="mangalsutra">mangalsutra</option>
                                    <option value="gold-coin">gold coin</option>
                                    <option value="earring">earring</option>
                                    <option value="ring">ring</option>
                                    <option value="pendent">pendent</option>
                                    <option value="nose-ring">nose ring</option>
                                    <option value="neckless">neckless</option>
                                    <option value="bangle">bangle</option>
                                    <option value="bracelet">bracelet</option>
                                </select> -->

                                <!--  -->
                                <select name="product-categories" id="product-categories" required>
                                    <option value="mangalsutra" <?= ($fetch_products['categories'] == 'mangalsutra') ? 'selected' : ''; ?>>Mangalsutra</option>
                                    <option value="gold-coin" <?= ($fetch_products['categories'] == 'gold-coin') ? 'selected' : ''; ?>>Gold Coin</option>
                                    <option value="earring" <?= ($fetch_products['categories'] == 'earring') ? 'selected' : ''; ?>>Earring</option>
                                    <option value="ring" <?= ($fetch_products['categories'] == 'ring') ? 'selected' : ''; ?>>Ring</option>
                                    <option value="pendent" <?= ($fetch_products['categories'] == 'pendent') ? 'selected' : ''; ?>>Pendent</option>
                                    <option value="nose-ring" <?= ($fetch_products['categories'] == 'nose-ring') ? 'selected' : ''; ?>>Nose Ring</option>
                                    <option value="neckless" <?= ($fetch_products['categories'] == 'neckless') ? 'selected' : ''; ?>>Neckless</option>
                                    <option value="bangle" <?= ($fetch_products['categories'] == 'bangle') ? 'selected' : ''; ?>>Bangle</option>
                                    <option value="bracelet" <?= ($fetch_products['categories'] == 'bracelet') ? 'selected' : ''; ?>>Bracelet</option>
                                </select>

                                <!--  -->

                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <p>Weight</p>
                                <input type="text" name="product-weight" placeholder="30gm" value="<?= $fetch_products['weight']; ?>" required>
                            </div>
                            <div class="row">
                                <p>Gender</p>
                                <!-- <select name="product-gender-categories" id="product-gender-categories" value="<?= $fetch_products['gender']; ?>" required>
                                    <option value="men">men</option>
                                    <option value="women">women</option>
                                    <option value="kids">kids</option>
                                    <option value="kids">men and women both</option>
                                </select> -->

                                <!--  -->
                                <select name="product-gender-categories" id="product-gender-categories" required>
                                    <option value="men" <?= ($fetch_products['gender'] == 'men') ? 'selected' : ''; ?>>Men</option>
                                    <option value="women" <?= ($fetch_products['gender'] == 'women') ? 'selected' : ''; ?>>Women</option>
                                    <option value="kids" <?= ($fetch_products['gender'] == 'kids') ? 'selected' : ''; ?>>Kids</option>
                                    <option value="men and women both" <?= ($fetch_products['gender'] == 'men and women both') ? 'selected' : ''; ?>>Men and Women Both</option>
                                </select>
                                <!--  -->

                            </div>
                        </div>
                        <div class="row">
                            <p>Description</p>

                            <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <p>Tag Number</p>
                                <input type="text" name="product-tag-number" placeholder="Enter Product tag number" value="<?= $fetch_products['tag']; ?>">
                            </div>
                            <div class="row">
                                <p>Stock</p>
                                <input type="text" name="product-stock" placeholder="Enter product stock available" required value="<?= $fetch_products['stock']; ?>">
                            </div>
                        </div>


                        <div class="row">
                            <h2>Pricing Details</h2>
                        </div>
                        <hr>

                        <div class="col-3">
                            <div class="row">
                                <p>Price</p>
                                <input type="number" name="price" value="<?= $fetch_products['price']; ?>" placeholder="Enter product price" min="0" class="box" required max="9999999999" onkeypress="if(this.value.length == 10) return false;">

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
                                <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
                            </div>
                            <div class="row">
                                <span>Image 02 (required)</span>
                                <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
                            </div>
                            <div class="row">
                                <span>Image 03 (required)</span>
                                <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
                            </div>

                        </div>
                        <hr>
                        <div class="col-2">
                            <div class="row">

                                <input type="submit" value="Update Product" class="btn submit-btn" name="update">
                            </div>
                            <div class="row">
                                <input class="submit-btn" type="reset" name="product-reset" value="Reset">
                            </div>
                        </div>
                    </form>

        </div>
<?php
                }
            } else {
                echo '<p class="empty">no product found!</p>';
            }
?>

    </main>
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html>