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

// pergerakan otomatis colom form OTP
function moveToNext(element, index) {
  // Pindah fokus ke input berikutnya jika panjang input mencapai maksimal
  if (element.value.length === element.maxLength) {
    const nextInput = document.querySelectorAll("input")[index];
    if (nextInput) nextInput.focus();
  }
  // Pindah ke input sebelumnya jika input dihapus
  if (element.value === "" && index > 1) {
    const prevInput = document.querySelectorAll("input")[index - 2];
    if (prevInput) prevInput.focus();
  }
}

// Pengelompokan OTP
document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault(); // Mencegah pengiriman formulir default

  const inputs = document.querySelectorAll(".form-control");
  let otp = "";
  inputs.forEach((input) => (otp += input.value));

  // Tambahkan hasil gabungan ke elemen tersembunyi
  const hiddenInput = document.createElement("input");
  hiddenInput.type = "hidden";
  hiddenInput.name = "otp";
  hiddenInput.value = otp;
  this.appendChild(hiddenInput);

  // Submit formulir setelah penggabungan
  this.submit();
});
