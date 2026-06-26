<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email already exists.";
        exit();
    }

    $insert = "INSERT INTO users (full_name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    if (mysqli_query($conn, $insert)) {
        $_SESSION['user'] = ['name' => $name, 'email' => $email, 'phone' => $phone];
        header("Location: index.php?status=signup");
        exit();
    } else {
        echo "Signup failed!";
    }
}
?>