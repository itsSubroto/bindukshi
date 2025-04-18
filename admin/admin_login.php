<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php #include('../includes/admin_sidebar.php') 
    ?>
    <main>
        <div class="container login-container">
            <div class="login">
                <h2>Admin Login</h2>
                <form action="" method="post">
                    <input class="input" type="text" name="admin_username" id="admin_username" placeholder="Enter Username">
                    <input class="input" type="password" name="admin_password" id="admin_password" placeholder="Enter Password">
                    <input class="input submit-btn" type="submit" name="admin_login_submit" id="admin_login_submit" value="Login">
                </form>
            </div>

        </div>

    </main>
    <script src="../js/admin_dashboard.js" defer></script>
</body>

</html> -->


<?php

include '../includes/connect.php';

session_start();

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    //    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    //    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
    $select_admin->execute([$name, $pass]);
    $row = $select_admin->fetch(PDO::FETCH_ASSOC);

    if ($select_admin->rowCount() > 0) {
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        
        $message[] = 'incorrect username or password!';

        header('location:admin_dashboard.php');
    } else {
        $message[] = 'incorrect username or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->

    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>
    <?php include('../includes/admin_sidebar.php') ?>


    <section class="form-container container login-container">
        <div class="login">
            <h2>Login now</h2>
            <p>Default username = <span>admin</span> & password = <span>111</span></p>
            <?php include('../includes/error_messages.php') ?>

            <form action="" method="post">
                <input type="text" name="name" required placeholder="enter your username" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="password" name="pass" required placeholder="enter your password" maxlength="20" class="box input" oninput="this.value = this.value.replace(/\s/g, '')">
                <input type="submit" value="login now" class="btn input submit-btn" name="submit">
            </form>
        </div>
    </section>

</body>

</html>