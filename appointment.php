<?php
session_start();
require_once 'db.php';

// Get logged-in user email if available
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Appointment Booking</title>
  <link rel="stylesheet" href="./CSS/appointment.css" />
</head>
<body>
  <div class="background-shine"></div>

  <div class="container">
    <img src="Mainlogo3.jpg" alt="Curacare Logo" class="logo" />
    <h2>Appointment Booking</h2>

    <form id="appointmentForm">
      <div class="section">
        <div class="column">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" name="full_name" placeholder="Enter your full name" required />
        </div>
        <div class="column">
          <label for="contactNumber">Contact Number</label>
          <input type="tel" id="contactNumber" name="contact_number" placeholder="Enter your contact number" required />
        </div>
      </div>

      <div class="section">
        <div class="column">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email"
                 value="<?php echo htmlspecialchars($user_email); ?>" readonly required />
        </div>
        <div class="column">
          <label for="dateOfBirth">Date of Birth</label>
          <input type="date" id="dateOfBirth" name="date_of_birth" required />
        </div>
      </div>

      <div class="section">
        <div class="column">
          <label for="gender">Gender</label>
          <select id="gender" name="gender" required>
            <option value="">Select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="column">
          <label for="doctorName">Doctor's Name / Department</label>
          <input type="text" id="doctorName" name="doctor_name" placeholder="Enter doctor's name or department" required />
        </div>
      </div>

      <div class="section">
        <div class="column">
          <label for="preferredDateTime">Preferred Date & Time</label>
          <input type="datetime-local" id="preferredDateTime" name="preferred_datetime" required />
        </div>
        <div class="column">
          <label for="consultationMode">Preferred Mode of Consultation</label>
          <select id="consultationMode" name="consultation_mode" required>
            <option value="">Select</option>
            <option value="in-person">In-person</option>
            <option value="online">Online</option>
          </select>
        </div>
      </div>

      <div>
        <label for="medicalHistory">Medical History (if applicable)</label>
        <textarea id="medicalHistory" name="medical_history" placeholder="Mention any pre-existing conditions or allergies"></textarea>
      </div>

      <div>
        <label>
          <input type="checkbox" id="terms" required /> I agree to the Terms & Conditions
        </label>
      </div>

      <button type="submit" class="submit-btn">Book Appointment</button>
    </form>

    <div class="selected-products" id="selectedDetails" style="display:none;">
      <h3>Your Selected Details</h3>
      <div class="product">Doctor's Department: <strong id="selectedDoctor">Selected Department</strong></div>
      <div class="product">Mode of Consultation: <strong id="selectedMode">In-person / Online</strong></div>
      <div class="product">Appointment Date & Time: <strong id="selectedDateTime">Selected Date & Time</strong></div>
    </div>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.2239094560337!2d88.48367217476142!3d22.719917527555882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f8a20f7fc48ec1%3A0x68c152b3da3a29c6!2sChampadali%2C%20Barasat%2C%20Kolkata%2C%20West%20Bengal%20700124!5e0!3m2!1sen!2sin!4v1743264759326!5m2!1sen!2sin"
      width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>

  <script>
    // Auto-fill Doctor's Name from URL
    const params = new URLSearchParams(window.location.search);
    const doctor = params.get("doctor");
    if (doctor) document.getElementById("doctorName").value = decodeURIComponent(doctor);

    // Update selected details in real-time
    document.getElementById("doctorName").addEventListener("change", function() {
      document.getElementById("selectedDoctor").textContent = this.value || "Selected Department";
    });

    document.getElementById("consultationMode").addEventListener("change", function() {
      document.getElementById("selectedMode").textContent = this.options[this.selectedIndex].text || "In-person / Online";
    });

    document.getElementById("preferredDateTime").addEventListener("change", function() {
      const dateTimeValue = this.value;
      if (dateTimeValue) {
        const date = new Date(dateTimeValue);
        document.getElementById("selectedDateTime").textContent = date.toLocaleString();
      } else {
        document.getElementById("selectedDateTime").textContent = "Selected Date & Time";
      }
    });

    // Handle Form Submission with AJAX
    document.getElementById("appointmentForm").addEventListener("submit", function(e) {
      e.preventDefault();

      // Show selected details
      document.getElementById("selectedDetails").style.display = "block";

      // Get form data
      const formData = new FormData(this);

      // Send data via AJAX
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "process_appointment.php", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            try {
              const response = JSON.parse(xhr.responseText);
              if (response.status === "success") {
                showSuccessMessage();
              } else {
                alert("Error: " + response.message);
              }
            } catch (e) {
              alert("An error occurred while processing your request.");
              console.error(e);
            }
          } else {
            alert("An error occurred while processing your request.");
          }
        }
      };
      xhr.send(formData);
    });

    function showSuccessMessage() {
      const container = document.querySelector(".container");
      container.innerHTML = `
        <div class="success-message">
          <img src="booked.jpg" alt="Doctors"
            style="max-width: 280px; border-radius: 20px; box-shadow: 0 6px 14px rgba(0,0,0,0.1);
                   background: transparent; display: block; margin: 0 auto 25px;" />
          <h2>✅ Appointment Booked Successfully!</h2>
          <p>Thank you for booking with Curacare. Our team will reach out to confirm your appointment soon.</p>
          <a href="appointment.php" class="another-booking">📅 Book Another Appointment</a>
        </div>
      `;
    }
  </script>
</body>
</html>

