// Toggle Visibility Password
document.querySelectorAll(".toggle-password").forEach((button) => {
  button.addEventListener("click", () => {
    const passwordInput = button.previousElementSibling;
    const icon = button.querySelector("i");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("bi-eye-slash");
      icon.classList.add("bi-eye");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("bi-eye");
      icon.classList.add("bi-eye-slash");
    }
  });
});
