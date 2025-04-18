<?php

include 'connect.php';

session_start();
session_unset();
session_destroy();

header('location: ../admin/admin_login.php');
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="../admin/admin_login.php">
</a>
</body>
</html> -->