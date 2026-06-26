<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "curacare_db");

$testType = $_GET['test'] ?? '';

$sql = "SELECT id, question, option1, option2, option3, option4 
        FROM mental_health_questions WHERE test_type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $testType);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
  $questions[] = $row;
}

echo json_encode($questions);
?>
