<?php

include "includes/connect.php";

session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header("location: login.php");
}

include 'includes/wishlist_cart.php';



// Fetch admin details
$fetch_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$fetch_user->execute([$user_id]);
$fetch_profile = $fetch_user->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $name = strip_tags($name);
    //    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $update_profile_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
    $update_profile_name->execute([$name, $user_id]);

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass = $_POST['prev_pass'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = strip_tags($old_pass);
    //    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = strip_tags($new_pass);
    //    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = strip_tags($confirm_pass);
    //    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if ($old_pass == $empty_pass) {
        $message[] = 'please enter old password!';
    } elseif ($old_pass != $prev_pass) {
        $message[] = 'old password not matched!';
    } elseif ($new_pass != $confirm_pass) {
        $message[] = 'confirm password not matched!';
    } else {
        if ($new_pass != $empty_pass) {
            $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_admin_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'password updated successfully!';
        } else {
            $message[] = 'please enter a new password!';
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- <link rel="stylesheet" href="css/admin_style.css"> -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <div class="container">
        <div class="login-box">
            <h2>Update Profile</h2>
            <?php include('includes/error_messages.php') ?>

            <hr>
            <form action="" method="post" class="login-form">

                <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">

                <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="enter your username" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">

                <input type="password" name="old_pass" placeholder="enter old password" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">


                <input type="password" name="new_pass" placeholder="enter new password" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">

                <input type="password" name="confirm_pass" placeholder="confirm new password" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">

                <input type="submit" value="update now" class="btn input submit-btn" name="submit">
            </form>
        </div>

    </div>


    <script src="/js/header.js" defer></script>
    <script src="/js/home.js" defer></script>
</body>

</html>