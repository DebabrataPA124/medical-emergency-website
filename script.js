const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = () => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
};
loginBtn.onclick = () => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
};
signupLink.onclick = () => {
  signupBtn.click();
  return false;
};

function fun()
{
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  

if(username == 'Atanu07' && password == '12345')
{
  alert("Your login is successfully.")
  window.location.assign("appli.html")
}
else{
  alert("You enter wrong Input!");
}
}