<?php

include 'includes/connect.php';

session_start();
$message = array();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

if (isset($_POST['sign-up-submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_UNSAFE_RAW); // here they used the "FILTER_SANITIZE_STRING" which is deprecated now. So i replace it
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_UNSAFE_RAW);
    $password = sha1($_POST['password']);
    $password = filter_var($password, FILTER_UNSAFE_RAW);
    $cpassword = sha1($_POST['cpassword']);
    $cpassword = filter_var($cpassword, FILTER_UNSAFE_RAW);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email,]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $message[] = 'email already exists!';
    } else {

        if ($password != $cpassword) {
            $message[] = 'confirm password not matched!';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
            $insert_user->execute([$name, $email, $cpassword]);
            header('location:index.php');
            
            $message[] = 'registered successfully, login now please!';
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bindukshi Jewellers | Register</title>
    <link rel="stylesheet" href="../projectAgain/css/style.css">
</head>

<body>
    <!-- header php -->
    <?php
    include("includes/header.php")
    ?>

    <div class="message">
        <h2><?php
            for ($i = 0; $i < count($message); $i++) {
                echo $message[$i];
            }

            ?></h2>
    </div>

    <div class="container">
        <div class="login-box">
            <h2>Register You Self</h2>
            <form action="register.php" method="post" class="login-form">
                <input type="text" name="name" placeholder="Enter your Full Name" required>
                <input type="email" name="email" placeholder="Enter your Email" oninput="this.value = this.value.replace(/\s/g, '')" required>
                <input type="password" name="password" placeholder="Enter your Password" oninput="this.value = this.value.replace(/\s/g, '')" required>
                <input type="password" name="cpassword" placeholder="Confirm Password" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="submit" class="login-btn" name="sign-up-submit" value="Sign Up">
            </form>
            <p>Already have an account?</p>

            <a href="login.php" class="register-btn">Login Now</a>

        </div>
    </div>


    <!-- footer php -->
    <?php
    include("includes/footer.php")
    ?>
</body>

</html>