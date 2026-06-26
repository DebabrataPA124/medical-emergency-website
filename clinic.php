<?php
include "db.php"; // database connection

// Fetch from clinics table
$sql = "SELECT * FROM clinics ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clinic Locations</title>
  <style>
    body {
      background: #ffffff;
      margin: 0;
      padding: 30px;
      font-family: poppy;
    }

    .clinic-box {
      background: #f6ddcb;
      padding: 80px 60px;
      border-radius: 60px;
      width: 100%;
      max-width: 900px;
      margin: auto;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .section-header h2 {
      margin: 0;
      font-size: 40px;
      color: #0e716a;
      margin-bottom: 30px;
    }

    .clinic-cards {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .clinic-card {
      background: #fff;
      padding: 35px 45px;
      border-radius: 16px;
      box-shadow: 0 3px 6px rgba(190, 73, 73, 0.1);
      display: flex;
      align-items: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .clinic-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 12px rgba(5, 80, 99, 0.425);
    }

    .clinic-card img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
    }

    .info {
      flex: 1;
    }

    .info h3 {
      margin: 0;
      font-size: 23px;
      font-weight: 600;
      color: #0e716a;
    }

    .info p {
      margin: 4px 0;
      font-size: 17px;
      color: #0e716a;
    }

    .rating {
      margin-left: auto;
      font-weight: bold;
      color: #f08c6e;
      font-size: 25px;
    }
  </style>
</head>
<body>

<section class="clinic-box">
  <div class="section-header">
    <h2>Clinic Locations</h2>
  </div>

  <div class="clinic-cards">

    <?php 
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) { 
    ?>
      <div class="clinic-card">
        <img src="clinic.jpeg" alt="Clinic"/>

        <div class="info">
          <h3><?php echo $row['name']; ?></h3>
          <p class="location"><?php echo $row['location']; ?></p>
          <p><strong>Reception:</strong> <?php echo $row['contact_number']; ?></p>
        </div>

        <div class="rating"><?php echo $count; ?></div>
      </div>
    <?php 
      $count++; 
    } 
    ?>

  </div>
</section>

</body>
</html>

