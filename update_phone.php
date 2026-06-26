<?php
session_start();
include 'db.php';

header('Content-Type: text/plain'); // for debugging

// ✅ Check if user session exists
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['email'])) {
    echo "❌ Not logged in.";
    exit;
}

$email = $_SESSION['user']['email']; // Use email to find user
$phone = $_POST['phone'] ?? '';

if (!preg_match('/^[0-9\-\+\s\(\)]{7,20}$/', $phone)) {
    echo "❌ Invalid phone number.";
    exit;
}

// ✅ Update using email instead of user_id
$sql = "UPDATE users SET phone = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $phone, $email);

if ($stmt->execute()) {
    echo "✅ Phone number updated.";
} else {
    echo "❌ Failed to update. Error: " . $conn->error;
}

$conn->close();
?>
