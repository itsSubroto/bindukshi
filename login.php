<?php

include 'includes/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    header('location:index.php');
} else {
    $user_id = '';
};

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = strip_tags($email);
    $pass = sha1($_POST['pass']);
    $pass = strip_tags($pass);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];
        // $_SESSION['user_name'] = $row['name'];
        header('location:index.php');
        // echo $_SESSION["user_id"];
    } else {
        $message[] = 'incorrect username or password!';
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bindukshi Jewellers</title>
    <link rel="stylesheet" href="../projectAgain/css/style.css">
</head>

<body>
    <!-- header php -->
    <?php
    include("includes/header.php")
    ?>

    <div class="container">
        <div class="login-box">
            <h2>Login Now</h2>
            <form action="" method="post" class="login-form">
                <input type="text" name="email" placeholder="Enter your Full Email" required>
                <input type="password" name="pass" placeholder="Enter your Password" required>
                <input type="submit" class="login-btn" name="submit" value="Login">
            </form>
            <?php
            include("includes/error_messages.php")
            ?>

            <p>Don't have an account?</p>

            <a href="register.php" class="register-btn">Register Now</a>

        </div>
    </div>


    <!-- footer php -->
    <?php
    include("includes/footer.php")
    ?>
</body>

</html>