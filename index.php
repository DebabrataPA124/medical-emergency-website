<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Curacare Health Solutions</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="CSS/footer.css" rel="stylesheet"/>
  <link href="CSS/style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="CSS/doc_card.css">
  <link href="CSS/intro.css" rel="stylesheet"/>

  <style>
    .profile-slide {
  position: fixed;
  top: 0;
  right: -350px;
  width: 320px;
  height: 100vh;
  background: linear-gradient(135deg, #ffffff, #fef4f0);
  box-shadow: -8px 0 20px rgba(0, 0, 0, 0.1);
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
  padding: 30px 25px;
  transition: right 0.5s ease;
  z-index: 9999;
  overflow-y: auto;
  font-family: 'Poppins', sans-serif;
  border-left: 8px solid #ec7855; /* accent border */
}

    .profile-slide.open { right: 0; }
    .profile-header { display: flex; justify-content: space-between; align-items: center; }
    .profile-header h3 { margin: 0;font-weight:600; color: #000; }
    .close-btn {font-size: 24px;cursor: pointer;color: #444; /* dark grey */font-weight: bold;}
    .profile-form { margin-top: 20px; display: flex; flex-direction: column; }
    .profile-form label { font-weight: 600; margin-top: 10px; color:#000}
    .profile-form input {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .profile-actions {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .profile-actions button {
      padding: 8px 12px;
      border: none;
      background-color: #ec7855;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
    .nav-dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 6px;
      z-index: 9999;
      min-width: 200px;
      font-family: 'Poppins', sans-serif;
    }
    .nav-dropdown-menu ul {
      list-style: none;
      margin: 0;
      padding: 8px 0;
    }
    .nav-dropdown-menu ul li {
      padding: 10px 16px;
      cursor: pointer;
      transition: background 0.2s;
      color: #0f5132;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .nav-dropdown-menu ul li:hover {
      background-color: #f5f5f5;
    }
    .profile-dropdown {
      position: relative;
    }
    .profile-dropdown:hover .nav-dropdown-menu {
      display: block;
    }
    .profile-avatar {
  display: flex;
  justify-content: center;
  margin: 15px 0;
}

.icon-wrapper {
  position: relative;
  display: inline-block;
  animation: flipIn 0.6s ease forwards;
}

.icon-wrapper i {
  font-size: 80px;
  background-color: #ec7855;
  color: white;
  border-radius: 50%;
  padding: 10px;
  display: block;
}

.icon-wrapper .shine {
  position: absolute;
  top: 0;
  left: -75%;
  width: 50%;
  height: 100%;
  background: linear-gradient(
    120deg,
    rgba(255, 255, 255, 0.3) 0%,
    rgba(255, 255, 255, 0.6) 50%,
    rgba(255, 255, 255, 0.3) 100%
  );
  transform: skewX(-25deg);
  animation: shineEffect 1s ease-in-out 0.5s forwards;
}

@keyframes flipIn {
  from {
    transform: rotateY(90deg);
    opacity: 0;
  }
  to {
    transform: rotateY(0deg);
    opacity: 1;
  }
}

@keyframes shineEffect {
  0% {
    left: -75%;
  }
  100% {
    left: 125%;
  }
}
  </style>
</head>
<body>
  <!-- Intro Animation -->

<div id="intro">
  <div class="logo-brush"></div>
</div>

<!-- Loading Animation -->
<div class="loader-wrapper">
  <div class="loader"></div>
</div>
<!-- Header with Navigation -->
<header>
  <div class="logo-container" style="display: flex; align-items: center;">
    <img alt="Curacare Logo" class="logo" src="Mainlogo3.jpg" />
    <button class="mobile-menu-btn" title="Menu">
      <span class="menu-line"></span>
    </button>
   <nav>
            <ul class="nav-menu">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <span class="material-icons nav-icon">home</span>
                        <span class="nav-text">Home</span>
                    </a>
                </li>
                <!--mental_health_ quiz-->
                <li class="nav-item">
    <a class="nav-link" href="mental_health_tests/index.html">
        <span class="material-icons nav-icon">psychology</span>
        <span class="nav-text">Self Tests</span>
    </a>
</li>


                <li class="nav-item">
                    <a class="nav-link" href="#services">
                        <span class="material-icons nav-icon">build</span>
                        <span class="nav-text">Service</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#doctor-section" onclick="loadDoctorSection(event)">
                        <span class="material-icons nav-icon">local_hospital</span>
                        <span class="nav-text">Doctors</span>
                    </a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="clinic.php">
        <span class="material-icons nav-icon">local_hospital</span>
        <span class="nav-text">Clinic</span>
    </a>
</li>


                <li class="nav-item">
                    <a class="nav-link" href="#contact">
                        <span class="material-icons nav-icon">contact_mail</span>
                        <span class="nav-text">Contact</span>
                    </a>
                </li>
                <li class="nav-item profile-dropdown">
                    <a class="nav-link" href="#" id="navProfileIcon">
                        <span class="material-icons nav-icon">account_circle</span>
                        <span class="nav-text">Profile</span>
                    </a>
                    <div class="nav-dropdown-menu">
                        <ul>
                            <li onclick="openProfile()">
                                <span class="material-icons">person</span>
                                Profile
                            </li>
                            <li onclick="OpenHistory()">
                                <span class="material-icons">history</span>
                                History
                            </li>
                            <li onclick="logout()">
                                <span class="material-icons">logout</span>
                                Logout
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
  </div>
</header>
<!-- Profile Slide Panel -->
<div id="profilePanel" class="profile-slide">
  <div class="profile-header">
    <h3>My Profile</h3>
    <span class="close-btn" onclick="toggleProfileSlide()">×</span>
  </div>
  <div class="profile-avatar">
    <div class="icon-wrapper"id="animatedIcon" >
      <i class="fas fa-user-circle"></i>
      <div class="shine"></div>
    </div>
  </div>
  <form class="profile-form">
    <label for="profile-name">Full Name</label>
    <input type="text" id="profile-name" placeholder="Your name" disabled>
  
    <label for="profile-email">Email</label>
    <input type="email" id="profile-email" placeholder="you@example.com" disabled>
  
    <label for="profile-phone">Phone</label>
    <input type="text" id="profile-phone" placeholder="123-456-7890" disabled>
  
    <div class="profile-actions">
      <button type="button" onclick="editPhone()">Edit</button>
      <button type="button" id="saveProfileBtn" onclick="savePhoneNumber()" disabled>Save</button>
    </div>
  </form>
</div>
<!-- Hero Section -->
<div class="slider">

  <div class="list">

      <div class="item active">
          <img src="slider_images/handshake.jpeg"alt="">

          <div class="content">
              <div class="title">EMERGENCY <br> CARE</div>
              <div class="subtitle">
                   Medical attention available 24/7 <br> 
                  along with expert healthcare professionals...   
              </div>
              <div class="button">
                <input type="button" value="Get Started" onclick="window.location.href='login.html';">
            </div>
          </div>
      </div>

      <div class="item">
          <img src="slider_images/specialist.jpeg" alt="">

          <div class="content">
              <div class="title">SPECIALIZED DOCTORS</div>
              <div class="subtitle">
                  Highly qualified and skilled medical professionals <br>
                  across various specialists...
              </div>
              <div class="button">
                <input type="button" value="Get Started" onclick="window.location.href='login.html';">
            </div>
          </div>
      </div>
      

      <div class="item ">
          <img src="slider_images/scheduling.jpeg" alt="">

          <div class="content">
              <div class="title">SMART <br> SCHEDULING</div>
              <div class="subtitle">
                  Flexible time slots to suit patient  <br>
                  convenience and availability...
              </div>
              <div class="button">
                <input type="button" value="Get Started" onclick="window.location.href='login.html';">
            </div>
          </div>
      </div>

      <div class="item ">
          <img src="slider_images/interact.jpeg" alt="">

          <div class="content">
              <div class="title">Hassle-free <br>Interaction </div>
              <div class="subtitle">
                  Smooth communication between <br> patients and healthcare staff...
              </div>
              <div class="button">
                <input type="button" value="Get Started" onclick="window.location.href='login.html';">
            </div>
          </div>
      </div>


      <div class="item ">
          <img src="slider_images/map.jpeg" alt="">

          <div class="content">
              <div class="title">Find Nearby <br> Facilities</div>
              <div class="subtitle">
                  Locate the nearest doctor clinics or  <br>
                  outpatient hospitals with ease....
              </div>
              <div class="button">
                <input type="button" value="Get Started" onclick="window.location.href='login.html';">
            </div>
          </div>
      </div>


      <div class="item">
          <img src="slider_images/notifications.jpeg" alt="">

          <div class="content">
              <div class="title">KEEP NOTIFIED!</div>
              <div class="subtitle">
                  Timely alerts for appointments,<br>
                  health tips, and important updates...
              
              </div>
              <div class="button">
                <input type="button" value="Get Started" onclick="window.location.href='login.html';">
            </div>
          </div>
      </div>
  </div>

  

  <div class="thumbnail">

      <div class="item">
          <img src="slider_images/handshake.jpeg" alt="">
      </div>
      <div class="item">
          <img src="slider_images/specialist.jpeg" alt="">
      </div>
      <div class="item">
          <img src="slider_images/scheduling.jpeg" alt="">
      </div>
      <div class="item">
          <img src="slider_images/interact.jpeg" alt="">
      </div>
      <div class="item">
          <img src="slider_images/map.jpeg" alt="">
      </div>
      <div class="item">
          <img src="slider_images/notifications.jpeg" alt="">
      </div>
      

  </div>


  <div class="nextPrevArrows">
      <button class="prev"> < </button>
      <button class="next"> > </button>
  </div>


</div>
<!-- Login Modal -->
<div class="login-modal" id="login-modal">
<div class="container">
<div class="logo-container">
<img alt="Curacare Logo" class="logo" src="Mainlogo3.jpg"/>
</div>
<div class="form-container">
<div class="login-form active">
<h2>Welcome Back</h2>
<form id="loginForm">
<div class="input-group">
<input name="username" placeholder="Username" required="" type="text"/>
<i class="fas fa-user"></i>
</div>
<div class="input-group">
<input name="password" placeholder="Password" required="" type="password"/>
<i class="fas fa-lock"></i>
</div>
<div class="forgot-password">
<a href="#">Forgot Password?</a>
</div>
<button class="btn" type="submit">Login</button>
<div class="toggle-form">
                            Don't have an account? <span class="toggle-btn" data-form="signup">Sign Up</span>
</div>
</form>
</div>
<div class="signup-form">
<h2>Create Account</h2>
<form id="signupForm">
<div class="input-group">
<input name="fullname" placeholder="Full Name" required="" type="text"/>
<i class="fas fa-user"></i>
</div>
<div class="input-group">
<input name="email" placeholder="Email" required="" type="email"/>
<i class="fas fa-envelope"></i>
</div>
<div class="input-group">
<input name="password" placeholder="Password" required="" type="password"/>
<i class="fas fa-lock"></i>
</div>
<div class="input-group">
<input name="confirm_password" placeholder="Confirm Password" required="" type="password"/>
<i class="fas fa-lock"></i>
</div>
<button class="btn" type="submit">Sign Up</button>
<div class="toggle-form">
                            Already have an account? <span class="toggle-btn" data-form="login">Login</span>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Services Section -->
<section class="services" id="services">
<div class="services-container">
<div class="section-title">
<h2>Our Services</h2>
<p>Comprehensive healthcare solutions for your well-being</p>
</div>
<div class="services-grid">
<div class="service-card">
<span class="material-icons service-icon">local_hospital</span>
<h3>Emergency Care</h3>
<p>24/7 emergency medical services with state-of-the-art facilities and expert staff.</p>
</div>
<div class="service-card">
<span class="material-icons service-icon">medical_services</span>
<h3>Specialized Treatment</h3>
<p>Advanced medical procedures and specialized care for various health conditions.</p>
</div>
<div class="service-card">
<span class="material-icons service-icon">health_and_safety</span>
<h3>Preventive Care</h3>
<p>Regular health check-ups and preventive measures for long-term wellness.</p>
</div>
</div>
</div>
</section>

<!-- Doctor Section Placeholder -->
<section id="doctor-section" style="min-height: 300px;"></section>
<!--mental_ Health_quiz--->
<section id="mental-tests" style="min-height: 300px;"></section>

<!-- Clinic Section Placeholder -->
<section id="clinic-section" style="min-height: 300px;"></section>

<!-- Testimonials Section -->
<section class="testimonials">
<div class="testimonials-container">
<div class="section-title">
<h2>What Our Patients Say</h2>
<p>Real experiences from our valued patients</p>
</div>
<div class="testimonials-grid">
<div class="testimonial-card">
<div class="testimonial-content">
                        "The care and attention I received at Curacare was exceptional. The doctors are highly professional and truly care about their patients."
                    </div>
<div class="testimonial-author">
<img alt="John Doe" class="author-image" src="https://randomuser.me/api/portraits/men/1.jpg"/>
<div class="author-info">
<h4>John Doe</h4>
<p>Patient</p>
</div>
</div>
</div>
<div class="testimonial-card">
<div class="testimonial-content">
                        "Modern facilities and friendly staff make every visit comfortable. Highly recommended for quality healthcare services."
                    </div>
<div class="testimonial-author">
<img alt="Jane Smith" class="author-image" src="https://randomuser.me/api/portraits/women/1.jpg"/>
<div class="author-info">
<h4>Jane Smith</h4>
<p>Patient</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Scroll to Top Button -->
<div class="scroll-top">
<span class="material-icons">arrow_upward</span>
</div>
<!-- Footer Section -->
<!-- Footer Section -->
<footer class="footer">
  <div class="footer-content">
    <div class="footer-section">
      <h3>About Us</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Contact Info</h3>
      <p>Email: info@example.com</p>
      <p>Phone: +1 234 567 890</p>
      <p>Address: 123 Street Name, City, Country</p>
    </div>
    <div class="footer-section">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
        <a class="social-icon" href="#"><i class="fab fa-x"></i></a>
        <a href="#" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2024 Your Company. All rights reserved.</p>
  </div>
</footer>
<script src="Javascript/slider_loader.js" defer></script>
 <script src="Javascript/nav_bar.js" defer></script>
 <script>
  
  document.addEventListener("DOMContentLoaded", () => {
  setTimeout(() => {
    document.getElementById("intro").style.display = "none"; 
  }, 4000); // hide intro after animation
});

    function editPhone() {
      console.log("editPhone() called");
      const phoneInput = document.getElementById("profile-phone");
      phoneInput.disabled = false;
      document.getElementById("saveProfileBtn").disabled = false;
    }

    async function savePhoneNumber() {
      console.log("savePhoneNumber() called with:", document.getElementById("profile-phone").value);
      const phone = document.getElementById("profile-phone").value;
      if (!phone) {
        alert("❌ Please enter a valid phone number.");
        return;
      }
      // For now just simulate success:
      alert("✅ (Simulated) Saved “" + phone + "”");
      document.getElementById("profile-phone").disabled = true;
      document.getElementById("saveProfileBtn").disabled = true;
    }
</script>

</body>
</html>