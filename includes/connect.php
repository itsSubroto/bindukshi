<?php

$db_name = 'mysql:host=localhost;dbname=bindukshi';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

// to check the db connection

// ======================================
// if ($conn) {
//     echo "db connected";
// } else {
//     echo mysqli_error($conn);
// }
// ======================================