<?php

include 'includes/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

include 'includes/wishlist_cart.php';


if (isset($_POST['order'])) {

    $name = $_POST['name'];
    $name = strip_tags($name);
    $number = $_POST['number'];
    $number = strip_tags($number);
    $email = $_POST['email'];
    $email = strip_tags($email);
    $method = $_POST['payment-option'];
    $method = strip_tags($method);
    $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
    $address = strip_tags($address);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {

        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);

        $message[] = 'order placed successfully!';
    } else {
        $message[] = 'your cart is empty';
    }
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bindukshi Jewellers | checkout</title>
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


    <div class="container confirm-order">
        <form action="" method="POST">
            <div class="delivery">




                <h2>Delivery Address</h2>
                <select name="country" id="country">
                    <option value="india" default>India</option>
                    <option value="usa" default>usa</option>
                    <option value="canada" default>Canada</option>
                    <option value="london" default>London</option>
                    <option value="pakistan" default>Pakistan</option>
                </select>
                <div class="customer-name">
                    <input type="text" name="name" id="name" placeholder="Enter Your Name" maxlength="20" require>
                    <!-- <input type="text" name="lname" id="lname" placeholder="Last Name" require> -->
                </div>
                <!-- <div class="customer-address">
                    <textarea name="address" id="address" placeholder="Address" require></textarea>
                </div> -->
                <div class="customer-address number">



                    <input type="number" name="number" id="number" placeholder="Enter your phone number" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required></input>

                    <input type="email" name="email" placeholder="Enter Your Email" class="box" maxlength="50" required>

                    <!-- address line -->
                    <p>Address line 01 :</p>
                    <input type="text" name="flat" placeholder="e.g. Flat number" class="box" maxlength="50" required>

                    <p>Address line 02 :</p>
                    <input type="text" name="street" placeholder="e.g. Street Name" class="box" maxlength="50" required>


                    <!-- end of address line -->

                </div>
                <div class="city-state-pin">
                    <div class="city input">
                        <input type="text" name="city" id="city" placeholder="Enter City" require>
                    </div>
                    <div class="state input">
                        <input type="text" name="state" id="state" placeholder="Enter State" require>

                    </div>
                    <div class="pin input">
                        <input type="text" name="pin_code" id="pin" placeholder="Enter Pin Code" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" require>

                    </div>
                </div>
            </div>
            <div class="billing-address">
                <h2>Billing Address</h2>
                <div class="billing-radio">
                    <div class="billing-radio-input">
                        <input type="radio" name="billing-addr" id="same-as-shipping">Same as Shipping Address
                    </div>
                    <div class="billing-radio-input">
                        <input type="radio" name="billing-addr" id="different-billing">Use a Different Billing Address
                    </div>
                </div>
            </div>
            <div class="payment-method">
                <h2>Payment Method</h2>
                <div class="payment-option">
                    <div class="billing-radio-input payment-option-input">
                        <input type="radio" name="payment-option" id="upi" value="Pay with UPI" require>Pay with UPI
                    </div>
                    <div class="billing-radio-input payment-option-input">
                        <input type="radio" name="payment-option" id="credit-debit" value="Credit card, Debit card" require>Credit card, Debit card
                    </div>
                    <div class="billing-radio-input payment-option-input">
                        <input type="radio" name="payment-option" id="cash-on-delivery" value="Cash on Delivery" require>Cash on Delivery
                    </div>



                </div>

            </div>



            <div class="order-overview">
                <?php
                $grand_total = 0;
                $cart_items[] = '';
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                        $total_products = implode($cart_items);
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                ?>

                        <div class="product-final-detail">
                            <div class="product-final-detail-up">
                                <div class="product-final-img-name">
                                    <div class="product-final-img"><img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt=""></div>
                                    <div class="product-final-name"><?= $fetch_cart["name"] ?></div>
                                </div>
                                <hr>

                            </div>
                            <div class="product-final-detail-down">
                                <div class="product-final-total">Total</div>
                                <div class="product-final-final-total-price">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                    <span>(<?= '₹' . $fetch_cart['price'] . '/- x ' . $fetch_cart['quantity']; ?>) = <?= $fetch_cart['price'] * $fetch_cart['quantity'];  ?></span>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">your cart is empty!</p>';
                }
                ?>

                <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">


                <div class="product-final-detail">
                    <div class="product-final-detail-down">
                        <div class="product-final-total">Grant Total</div>
                        <div class="product-final-final-total-price">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            <span><?= $grand_total ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pay-now">
                <input type="submit" name="order" value="Place Order" id="pay-now" class="<?= ($grand_total > 1) ? '' : 'disabled'; ?>">
            </div>
        </form>
    </div>


    <!-- footer php -->
    <?php
    include("includes/footer.php")
    ?>

    <!-- script of cart.js -->

    <!-- End of script of cart.js -->

</body>

</html>