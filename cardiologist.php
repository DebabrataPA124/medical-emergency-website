<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cardiologist Section</title>
  <style>
    body {
      background: #ffffff;
      margin: 0;
      padding: 30px;
      font-family: poppy;
    }

    .doctor-specialty {
      background: #f6ddcb;
      padding: 80px 60px;
      border-radius: 60px;
      width: 100%;
      max-width: 900px;
      margin: auto;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .section-header h2 {
      margin: 0;
      font-size: 40px;
      color: #0e716a;
    }

    .doctor-cards {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .doctor-card {
      background: #fff;
      padding: 35px 45px;
      border-radius: 16px;
      box-shadow: 0 3px 6px rgba(190, 73, 73, 0.1);
      display: flex;
      align-items: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .doctor-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 12px rgba(5, 80, 99, 0.425);
    }

    .doctor-card img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
    }

    .doctor-card .info {
      flex: 1;
    }

    .doctor-card .info h3 {
      margin: 0;
      font-size: 20px;
      font-weight: 600;
      color: #0e716a;
    }

    .doctor-card .info p {
      margin: 2px 0;
      font-size: 17px;
      color: #0e716a;
    }

    .doctor-card .location {
      font-size: 12px;
      color: #0e716a;
    }

    .doctor-card .rating {
      font-weight: bold;
      color: #f08c6e;
      font-size: 25px;
      margin-left: 10px;
    }

    /* ✅ Appointment Button */
    .appointment-btn {
      display: inline-block;
      margin-top: 10px;
      background: #0e716a;
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      transition: background 0.3s ease;
    }

    .appointment-btn:hover {
      background: #f08c6e;
    }

    .go-back {
      margin-top: 25px;
      text-align: right;
      background: #f6ddcb;
      padding: 10px 0;
      z-index: 10;
    }

    .go-back a {
      font-size: 14px;
      color: #0e716a;
      text-decoration: none;
    }

    .go-back a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .doctor-specialty {
        padding: 50px 30px;
        border-radius: 16px;
      }
      .doctor-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 25px;
      }
      .doctor-card img {
        margin-right: 0;
        margin-bottom: 15px;
      }
      .doctor-card .rating {
        margin-left: 0;
        margin-top: 10px;
      }
      .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      .go-back {
        text-align: center;
        bottom: 0;
      }
    }
  </style>
</head>
<body>

<section class="doctor-specialty">
  <div class="section-header">
    <h2>Cardiologist</h2>
  </div>

  <div class="doctor-cards">
    <?php
      $sql = "SELECT * FROM doctors WHERE specialization = 'Cardiologist'";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $doctor_id = $row['id'];
              echo '<div class="doctor-card">
                      <img src="' . htmlspecialchars($row["photo"]) . '" alt="Doctor" />
                      <div class="info">
                        <h3>' . htmlspecialchars($row["name"]) . '</h3>
                        <p>' . htmlspecialchars($row["qualification"]) . '</p>
                        <p class="location">' . htmlspecialchars($row["location"]) . '</p>
                        <p><strong>Appointments:</strong></p>
                        <ul style="margin:5px 0;padding-left:20px;font-size:14px;color:#0e716a;">';

              $appt_sql = "SELECT week_number, day_of_week, start_time, end_time 
                           FROM appointments 
                           WHERE doctor_id = $doctor_id
                           ORDER BY week_number ASC";
              $appt_result = $conn->query($appt_sql);

              if ($appt_result && $appt_result->num_rows > 0) {
                  while ($appt = $appt_result->fetch_assoc()) {
                      echo '<li><strong>Week ' . $appt['week_number'] . ', ' . $appt['day_of_week'] . ':</strong> ' .
                            date("g:i A", strtotime($appt['start_time'])) . ' – ' .
                            date("g:i A", strtotime($appt['end_time'])) . '</li>';
                  }
              } else {
                  echo '<li>No appointments available</li>';
              }

              echo '</ul>
                    <a class="appointment-btn" href="../appointment.php?doctor=' . urlencode($row["name"]) . '">Book Appointment</a>
                    </div>
                    <div class="rating">' . htmlspecialchars($row["rating"]) . '</div>
                  </div>';
          }
      } else {
          echo "<p>No cardiologists found in the database.</p>";
      }

      $conn->close();
    ?>
  </div>

  <div class="go-back">
    <a href="javascript:history.back()">← Go Back</a>
  </div>
</section>

</body>
</html>
