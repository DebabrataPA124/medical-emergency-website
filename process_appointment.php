<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve logged-in user's email (IMPORTANT FIX)
    $user_email = $_SESSION['user']['email'];

    // Get form data
    $full_name = trim($_POST['full_name'] ?? '');
    $contact_number = trim($_POST['contact_number'] ?? '');
    $date_of_birth = trim($_POST['date_of_birth'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $doctor_name = trim($_POST['doctor_name'] ?? '');
    $preferred_datetime = trim($_POST['preferred_datetime'] ?? '');
    $consultation_mode = trim($_POST['consultation_mode'] ?? '');
    $medical_history = trim($_POST['medical_history'] ?? '');

    // Validate required fields
    $errors = [];
    if (empty($full_name)) $errors[] = "Full name is required";
    if (empty($contact_number)) $errors[] = "Contact number is required";
    if (empty($date_of_birth)) $errors[] = "Date of birth is required";
    if (empty($gender)) $errors[] = "Gender is required";
    if (empty($doctor_name)) $errors[] = "Doctor's name is required";
    if (empty($preferred_datetime)) $errors[] = "Preferred date & time is required";
    if (empty($consultation_mode)) $errors[] = "Consultation mode is required";

    // If validation errors exist
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'message' => implode(', ', $errors)]);
        exit();
    }

    // Insert into booking_history
    $stmt = $conn->prepare("
        INSERT INTO booking_history (user_email, full_name, doctor, datetime, mode, notes, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
        exit();
    }

    // Create notes field
    $notes = "Contact: $contact_number, DOB: $date_of_birth, Gender: $gender, Medical History: $medical_history";

    $stmt->bind_param("ssssss", 
        $user_email,
        $full_name,
        $doctor_name,
        $preferred_datetime,
        $consultation_mode,
        $notes
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Appointment booked successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error booking appointment: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
