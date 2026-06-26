<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'name' => $user['full_name'],
            'email' => $user['email'],
            'phone' => $user['phone']
        ];
        header("Location: index.php?status=login");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>