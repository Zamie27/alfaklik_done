// DOM Elements
const registerLink = document.getElementById("register-link");
const loginLink = document.getElementById("login-link");
const userSection = document.getElementById("user-section");
const usernameSpan = document.getElementById("username");

// Sembunyikan nama pengguna lebih dari 10 huruf
document.addEventListener("DOMContentLoaded", function () {
  const userNameElement = document.getElementById("user-name");
  const fullName = userNameElement.textContent.trim(); // Ambil nama lengkap

  if (fullName.length > 10) {
    const shortName = `${fullName.substring(0, 10)}...`; // Potong setelah 6 karakter
    userNameElement.textContent = shortName;
  }
});
