<?php

include '../includes/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    //    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    //    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    //    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
    $select_admin->execute([$name]);

    if ($select_admin->rowCount() > 0) {
        $message[] = 'username already exist!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } else {
            $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
            $insert_admin->execute([$name, $cpass]);
            $message[] = 'new admin registered successfully!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->

    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <?php include '../includes/admin_sidebar.php'; ?>

    <section class="form-container container login-container">
        <div class="login">

            <h2>Register Now</h2>
            <?php include '../includes/error_messages.php'; ?>
            <form action="" method="post">
                <input type="text" name="name" required placeholder="enter your username" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="password" name="pass" required placeholder="enter your password" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="submit" value="register now" class="btn input submit-btn" name="submit">
            </form>
        </div>

    </section>












    <script src="../js/admin_script.js"></script>

</body>

</html>