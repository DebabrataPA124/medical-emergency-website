<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "curacare_db");

$testType = $_GET['test'] ?? '';
$level = $_GET['level'] ?? '';

$sql = "SELECT doctor_tip, self_help_suggestions 
        FROM mental_health_guides 
        WHERE test_type = ? AND severity_level = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $testType, $level);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode($result->fetch_assoc());
?>
