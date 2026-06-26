// Fetch user profile data from backend
async function fetchProfile() {
  const res = await fetch("get_profile.php");
  return await res.json();
}

// Toggle the profile panel
function toggleProfileSlide() {
  document.getElementById("profilePanel").classList.toggle("open");
}

// Open the profile panel and load user info
function openProfile() {
  const panel = document.getElementById("profilePanel");
  panel.classList.add("open");

  const icon = document.getElementById("animatedIcon");
  if (icon) {
    icon.classList.remove("icon-wrapper");
    void icon.offsetWidth;
    icon.classList.add("icon-wrapper");
  }
}

// Edit phone field
function editPhone() {
  const phoneInput = document.getElementById("profile-phone");
  phoneInput.disabled = false;
  document.getElementById("saveProfileBtn").disabled = false;
}

// Save phone number to the database
async function savePhoneNumber() {
  const phone = document.getElementById("profile-phone").value;

  if (!phone) {
    alert("❌ Please enter a phone number.");
    return;
  }

  try {
    const response = await fetch("update_phone.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      credentials: "include",
      body: `phone=${encodeURIComponent(phone)}`
    });

    const result = await response.text();
    alert(result);

    if (result.startsWith("✅")) {
      document.getElementById("profile-phone").disabled = true;
      document.getElementById("saveProfileBtn").disabled = true;
    }
  } catch (error) {
    console.error("⛔ Error saving phone number:", error);
    alert("❌ Failed to connect to server.");
  }
}

// Load profile + appointment button + success popup
document.addEventListener("DOMContentLoaded", async () => {
  const user = await fetchProfile();

  if (user) {
    document.getElementById("profile-name").value = user.name;
    document.getElementById("profile-email").value = user.email;
    document.getElementById("profile-phone").value = user.phone;

    // ✅ Success message on login/signup
    const url = new URL(window.location);
    const status = url.searchParams.get("status");

    if (status === "login" || status === "signup") {
      const popup = document.getElementById("success-popup");
      popup.textContent = status === "login"
        ? "✅ Successfully Logged In!"
        : "✅ Successfully Signed Up!";
      popup.style.display = "block";
      setTimeout(() => { popup.style.display = "none"; }, 3000);

      url.searchParams.delete("status");
      window.history.replaceState({}, document.title, url.pathname);
    }
  } else {
    console.log("⛔ Not logged in");
  }
});

// Load doctor section dynamically
// Load doctor section dynamically
async function loadDoctorSection(event) {
  event.preventDefault();
  const section = document.getElementById("doctor-section");

  try {
    const response = await fetch("specialists/speciality.php");
    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

    const html = await response.text();
    section.innerHTML = html;
    section.dataset.loaded = "true";

    // Load the CSS
    const cssLink = document.createElement("link");
    cssLink.rel = "stylesheet";
    cssLink.href = "specialists/speciality.css";
    document.head.appendChild(cssLink);

    // Run embedded JS (if any)
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = html;
    const scripts = tempDiv.querySelectorAll("script");
    scripts.forEach(script => {
      const newScript = document.createElement("script");
      newScript.text = script.innerText;
      document.body.appendChild(newScript);
    });

    console.log("✅ speciality.php loaded successfully!");
  } catch (error) {
    console.error("❌ Failed to load speciality.php:", error);
    section.innerHTML = "<p style='color:red;'>Failed to load doctors.</p>";
  }

  section.scrollIntoView({ behavior: "smooth" });
}

// Load mental health self-tests dynamically
async function loadMentalTests(event) {
  event.preventDefault();
  const section = document.getElementById("mental-tests");

  if (!section.dataset.loaded) {
    try {
      const response = await fetch("mental_health_tests/adhd.html"); 
      // 👆 default test page (you can later make dropdown for others)
      const html = await response.text();
      section.innerHTML = html;
      section.dataset.loaded = "true";

      // Attach CSS if needed
      const css = document.createElement("link");
      css.rel = "stylesheet";
      css.href = "mental_health_tests/tests.css"; // adjust if your CSS inside
      document.head.appendChild(css);
    } catch (err) {
      section.innerHTML = "<p style='color:red;'>⚠️ Failed to load self-test.</p>";
    }
  }

  section.scrollIntoView({ behavior: "smooth" });
}

// Logout
function logout() {
  window.location.href = "logout.php";
}

// Open history panel with past appointments
        function OpenHistory() {
    window.location.href = "/final_curacare/history.php";
}
