<?php
session_start();
require_once "db.php";

// Check login
if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$user_email = $_SESSION['user']['email'];

// Prepare and execute query
$stmt = $conn->prepare("SELECT * FROM booking_history WHERE user_email = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();

$result = $stmt->get_result();
$history = [];

while ($row = $result->fetch_assoc()) {
    $history[] = [
        "full_name" => $row["full_name"],
        "doctor"    => $row["doctor"],
        "datetime"  => $row["datetime"],
        "mode"      => $row["mode"],
        "notes"     => $row["notes"],
        "created_at"=> $row["created_at"]
    ];
}

echo json_encode($history);

$stmt->close();
$conn->close();

