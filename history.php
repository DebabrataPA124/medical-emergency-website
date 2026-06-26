<?php
session_start();
require_once "db.php";

// User must be logged in
if (!isset($_SESSION['user'])) {
    echo "<h2>Please login to view your appointment history.</h2>";
    exit();
}

$user_email = $_SESSION['user']['email'];

// Fetch data
$stmt = $conn->prepare("SELECT * FROM booking_history WHERE user_email = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$history = [];
while ($row = $result->fetch_assoc()) {
    $history[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Appointment History</title>

<style>
    body {
        background: #ffffff;
        margin: 0;
        padding: 30px;
        font-family: poppins, sans-serif;
    }

    .history-box {
        background: #f6ddcb;
        padding: 60px 50px;
        border-radius: 40px;
        max-width: 900px;
        margin: auto;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    h2 {
        margin: 0;
        font-size: 40px;
        color: #0e716a;
        margin-bottom: 30px;
        text-align: center;
    }

    .history-cards {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .history-card {
        background: #fff;
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 3px 6px rgba(190, 73, 73, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .history-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 12px rgba(5, 80, 99, 0.35);
    }

    .history-card h3 {
        margin: 0;
        font-size: 23px;
        font-weight: 600;
        color: #0e716a;
    }

    .history-card p {
        margin: 6px 0;
        font-size: 16px;
        color: #0e716a;
    }

</style>
</head>
<body>

<section class="history-box">
    <h2>📖 Appointment History</h2>

    <div class="history-cards">

        <?php if (count($history) > 0): ?>
            <?php foreach ($history as $a): ?>
            
                <div class="history-card">
                    <h3><?php echo htmlspecialchars($a["full_name"]); ?></h3>

                    <p>🧑‍⚕️ <strong>Doctor:</strong> 
                        <?php echo htmlspecialchars($a["doctor"]); ?>
                    </p>

                    <p>📅 <strong>Date & Time:</strong> 
                        <?php echo date("d/m/Y, h:i A", strtotime($a["datetime"])); ?>
                    </p>

                    <p>💻 <strong>Mode:</strong> 
                        <?php echo htmlspecialchars($a["mode"]); ?>
                    </p>

                    <p>📝 <strong>Notes:</strong><br>
                        <?php echo nl2br(htmlspecialchars($a["notes"])); ?>
                    </p>
                </div>

            <?php endforeach; ?>
        <?php else: ?>

            <p style="text-align:center; font-size:18px; color:#0e716a;">
                No appointment history found.
            </p>

        <?php endif; ?>

    </div>
</section>

</body>
</html>

